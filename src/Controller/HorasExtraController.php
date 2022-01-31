<?php

namespace App\Controller;

use App\Entity\HorasExtra;
use App\Entity\User;
use App\Form\HorasExtraType;
use App\Repository\HorasExtraRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/horas/extra")
 */
class HorasExtraController extends AbstractController
{
    /**
     * @Route("/user/{id}", name="horas_extra_index", methods={"GET"})
     */
    public function index(HorasExtraRepository $horasExtraRepository, $id,  EntityManagerInterface $entityManager): Response
    {

        $user= $entityManager->getRepository(User::class)->find($id);
        return $this->render('horas_extra/index.html.twig', [
            'user'=>$user,
            'horas_extras' => $horasExtraRepository->findBy(['user'=>$user]),
        ]);
    }


     /**
     * @Route("/mis_horas", name="my_horas", methods={"GET"})
     */
    public function horas_my(HorasExtraRepository $horasExtraRepository): Response
    {

        $user= $this->getUser();
        return $this->render('horas_extra/mis_horas.html.twig', [
            'horas_extras' => $horasExtraRepository->findBy(['user'=>$user]),
        ]);
    }

    /**
     * @Route("/new", name="horas_extra_new", methods={"GET", "POST"})
     */
    public function new(Request $request, EntityManagerInterface $entityManager): Response
    {
        $user= $this->getUser();
        $horasExtra = new HorasExtra();
        $form = $this->createForm(HorasExtraType::class, $horasExtra);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $horasExtra->setUser($user);
            $entityManager->persist($horasExtra);
            $entityManager->flush();

            return $this->redirectToRoute('my_horas', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('horas_extra/new.html.twig', [
            'horas_extra' => $horasExtra,
            'form' => $form,
        ]);
    }

    /**
     * @Route("/{id}", name="horas_extra_show", methods={"GET"})
     */
    public function show(HorasExtra $horasExtra): Response
    {
        return $this->render('horas_extra/show.html.twig', [
            'horas_extra' => $horasExtra,
        ]);
    }

    /**
     * @Route("/{id}/edit", name="horas_extra_edit", methods={"GET", "POST"})
     */
    public function edit(Request $request, HorasExtra $horasExtra, EntityManagerInterface $entityManager): Response
    {
        $form = $this->createForm(HorasExtraType::class, $horasExtra);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->flush();

            return $this->redirectToRoute('horas_extra_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('horas_extra/edit.html.twig', [
            'horas_extra' => $horasExtra,
            'form' => $form,
        ]);
    }

    /**
     * @Route("/{id}", name="horas_extra_delete", methods={"POST"})
     */
    public function delete(Request $request, HorasExtra $horasExtra, EntityManagerInterface $entityManager): Response
    {
        if ($this->isCsrfTokenValid('delete'.$horasExtra->getId(), $request->request->get('_token'))) {
            $entityManager->remove($horasExtra);
            $entityManager->flush();
        }

        return $this->redirectToRoute('my_horas', [], Response::HTTP_SEE_OTHER);
    }
}
