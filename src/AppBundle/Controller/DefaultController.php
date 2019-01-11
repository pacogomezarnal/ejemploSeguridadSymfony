<?php

namespace AppBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use AppBundle\Entity\Usuario;
use AppBundle\Form\UsuarioType;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;


class DefaultController extends Controller
{
    /**
     * @Route("/", name="homepage")
     */
    public function indexAction(Request $request)
    {
        // replace this example code with whatever you need
        return $this->render('default/index.html.twig', [
            'base_dir' => realpath($this->getParameter('kernel.project_dir')).DIRECTORY_SEPARATOR,
        ]);
    }

    /**
     * @Route("/registro", name="registro")
     */
    public function registroAction(Request $request, UserPasswordEncoderInterface $passwordEncoder)
    {
      // 1) build the form
      $user = new Usuario();
      $form = $this->createForm(UsuarioType::class, $user);

      // 2) handle the submit (will only happen on POST)
      $form->handleRequest($request);
      if ($form->isSubmitted() && $form->isValid()) {

          // 3) Encode the password (you could also do this via Doctrine listener)
          $password = $passwordEncoder->encodePassword($user, $user->getPlainPassword());
          $user->setPassword($password);

          // 4) save the User!
          $entityManager = $this->getDoctrine()->getManager();
          $entityManager->persist($user);
          $entityManager->flush();

          // ... do any other work - like sending them an email, etc
          // maybe set a "flash" success message for the user

          return $this->redirectToRoute('usuarios');
      }

      return $this->render(
          'seguridad/registro.html.twig',
          array('form' => $form->createView())
      );
    }
}
