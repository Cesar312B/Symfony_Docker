<?php

namespace App\Controller;

use App\Entity\User;
use App\Form\UserEditType;
use App\Form\UserType;
use App\Repository\UserRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\IsGranted;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Security;

/**
 * @Route("/user")
 */
class UserController extends AbstractController
{
    /**
     * @Route("/lista_usuarios", name="user_index", methods={"GET"})
     * @IsGranted("ROLE_ADMIN",message="No tiene acceso a esta pagina")
     */
    public function index(UserRepository $userRepository): Response
    {
          /*Mostrar lista filtrada de empleados sin rol admin */
          $em = $this->getDoctrine()->getManager();
          $qb = $em->createQueryBuilder();
         $qb->select('u') ->from(User::class, 'u') ->where('u.roles LIKE :roles') 
         ->setParameter('roles', '%"'."ROLE_USER".'"%')

  
         ;
  
         $users = $qb->getQuery()->getResult();
          
          return $this->render('user/index.html.twig', [
              'users' => $users,
          ]);
    }

    /**
     * @Route("/new", name="user_new", methods={"GET", "POST"})
     */
    public function new(Request $request, EntityManagerInterface $entityManager,UserPasswordHasherInterface $userPasswordHasher): Response
    {
        $user = new User();
        $roles[] = 'ROLE_USER';
        $form = $this->createForm(UserType::class, $user);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $user->setPuesto('Empleado');
            $user->setRoles($roles);
            $user->setPassword(
                $userPasswordHasher->hashPassword(
                        $user,
                        $form->get('password')->getData()
                    )
                );
            $entityManager->persist($user);
            $entityManager->flush();

            return $this->redirectToRoute('login', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('user/new.html.twig', [
            'user' => $user,
            'form' => $form,
        ]);
    }


         /**
     * @Route("/new_admin", name="nuevo_admin", methods={"GET","POST"})
     */
    public function new_admin(Request $request, UserPasswordHasherInterface $userPasswordHasher): Response
    {  /* Registro automatico del rol admin */
        $user = new User();
    
        $roles[] = 'ROLE_ADMIN';
      
            $entityManager = $this->getDoctrine()->getManager();
            $user->setUsername('administrador');
            $user->setNombre('administrador');
            $user->setApellido('administrador');
            $user->setRoles($roles);
            $user->setPassword(
                $userPasswordHasher->hashPassword(
                        $user,
                        'admin@admin.com'
                    )
                );
            $entityManager->persist($user);
            $entityManager->flush();

         
        
           
        return $this->render('user/new_admin.html.twig', [
          'user'=>'se guardo un administrador'
        ]);
    }

    /**
     * @Route("/{id}", name="user_show", methods={"GET"})
     */
    public function show(User $user): Response
    {
        return $this->render('user/show.html.twig', [
            'user' => $user,
        ]);
    }

    /**
     * @Route("/{id}/edit", name="user_edit", methods={"GET", "POST"})
     * @IsGranted("ROLE_ADMIN",message="No tiene acceso a esta pagina")
     */
    public function edit(Request $request, User $user, EntityManagerInterface $entityManager): Response
    {
        $form = $this->createForm(UserEditType::class, $user);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->flush();

            return $this->redirectToRoute('user_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('user/edit.html.twig', [
            'user' => $user,
            'form' => $form,
        ]);
    }

    /**
     * @Route("/{id}", name="user_delete", methods={"POST"})
     * @IsGranted("ROLE_ADMIN",message="No tiene acceso a esta pagina")
     */
    public function delete(Request $request, User $user, EntityManagerInterface $entityManager): Response
    {
        if ($this->isCsrfTokenValid('delete'.$user->getId(), $request->request->get('_token'))) {
            $entityManager->remove($user);
            $entityManager->flush();
        }

        return $this->redirectToRoute('user_index', [], Response::HTTP_SEE_OTHER);
    }
}
