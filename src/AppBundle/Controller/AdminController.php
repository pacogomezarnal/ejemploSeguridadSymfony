<?php

namespace AppBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use AppBundle\Entity\Usuario;
use AppBundle\Form\UsuarioType;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;
use Symfony\Component\Security\Http\Authentication\AuthenticationUtils;


/**
 * Usuario controller.
 *
 * @Route("admin")
 */
class AdminController extends Controller
{
  /**
   * @Route("/usuarios", name="usuarios")
   */
  public function usuariosAction(Request $request)
  {
    $em = $this->getDoctrine()->getManager();
    $usuarios = $em->getRepository('AppBundle:Usuario')->findAll();

    return $this->render('admin/index.html.twig', array(
        'usuarios' => $usuarios,
    ));
  }
  /**
   * @Route("/login", name="login")
   */
  public function loginAction(AuthenticationUtils $authenticationUtils)
  {
      // get the login error if there is one
      $error = $authenticationUtils->getLastAuthenticationError();

      // last username entered by the user
      $lastUsername = $authenticationUtils->getLastUsername();

      return $this->render('default/login.html.twig', array(
          'last_username' => $lastUsername,
          'error'         => $error,
      ));
  }
}
