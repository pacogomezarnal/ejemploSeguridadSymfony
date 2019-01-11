<?php

namespace AppBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use AppBundle\Entity\Usuario;
use AppBundle\Form\UsuarioType;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;


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
}
