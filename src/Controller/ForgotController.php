<?php

namespace App\Controller;


use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use App\Form\ChangePasswordType;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\IsGranted;


class ForgotController extends  AbstractController 
{
    /**
     * @Route("/forgot", name="forgot")
     */
    public function index(Request $request, UserPasswordEncoderInterface $encoder): Response
    {
        /* Actualiza contraseña de Usuario */
        $entityManager = $this->getDoctrine()->getManager();
        /* Crea formulario de cambio de contraseña */
        $userInfo = ['password' => null];
        $form = $this->createForm(ChangePasswordType::class, $userInfo);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {

            $userInfo = $form->getData();
            /* Obtiene usuario actualmente logeado */
            $username = $this->getUser();
            $plainPassword = $userInfo['password'];

            
            $password = $encoder->encodePassword($username, $plainPassword);

            $username->setPassword($password);
            $entityManager->flush();
            
 
            return $this->redirectToRoute('user_index');
               
        }

        return $this->render('login/forgot.html.twig', array('form' => $form->createView()));
    }

      
    
}
