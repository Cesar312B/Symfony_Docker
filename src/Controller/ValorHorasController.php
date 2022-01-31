<?php

namespace App\Controller;

use App\Entity\ValorHoras;
use App\Form\ValorHorasType;
use App\Repository\ValorHorasRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\IsGranted;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Security;

/**
 * @Route("/valor/horas")
 * @IsGranted("ROLE_ADMIN",message="Solo el admin tiene acceso")
 */
class ValorHorasController extends AbstractController
{
    /**
     * @Route("/", name="valor_horas_index", methods={"GET"})
     */
    public function index(ValorHorasRepository $valorHorasRepository): Response
    {
        return $this->render('valor_horas/index.html.twig', [
            'valor_horas' => $valorHorasRepository->findAll(),
        ]);
    }

    /**
     * @Route("/new", name="valor_horas_new", methods={"GET", "POST"})
     */
    public function new(Request $request, EntityManagerInterface $entityManager): Response
    {
        $valorHora = new ValorHoras();
        $form = $this->createForm(ValorHorasType::class, $valorHora);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->persist($valorHora);
            $entityManager->flush();

            return $this->redirectToRoute('valor_horas_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('valor_horas/new.html.twig', [
            'valor_hora' => $valorHora,
            'form' => $form,
        ]);
    }

    /**
     * @Route("/{id}", name="valor_horas_show", methods={"GET"})
     */
    public function show(ValorHoras $valorHora): Response
    {
        return $this->render('valor_horas/show.html.twig', [
            'valor_hora' => $valorHora,
        ]);
    }

    /**
     * @Route("/{id}/edit", name="valor_horas_edit", methods={"GET", "POST"})
     */
    public function edit(Request $request, ValorHoras $valorHora, EntityManagerInterface $entityManager): Response
    {
        $form = $this->createForm(ValorHorasType::class, $valorHora);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->flush();

            return $this->redirectToRoute('valor_horas_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('valor_horas/edit.html.twig', [
            'valor_hora' => $valorHora,
            'form' => $form,
        ]);
    }

    /**
     * @Route("/{id}", name="valor_horas_delete", methods={"POST"})
     */
    public function delete(Request $request, ValorHoras $valorHora, EntityManagerInterface $entityManager): Response
    {
        if ($this->isCsrfTokenValid('delete'.$valorHora->getId(), $request->request->get('_token'))) {
            $entityManager->remove($valorHora);
            $entityManager->flush();
        }

        return $this->redirectToRoute('valor_horas_index', [], Response::HTTP_SEE_OTHER);
    }
}
