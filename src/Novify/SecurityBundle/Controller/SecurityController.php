<?php

namespace Novify\SecurityBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\Security\Core\SecurityContext;
use Novify\ModelBundle\Entity\Utilisateurs;
use Novify\ModelBundle\Form\SignupType;
use Symfony\Component\HttpFoundation\Session\Session;

class SecurityController extends Controller
{
    public function indexAction($name)
    {
        return $this->render('NovifySecurityBundle:Default:index.html.twig', array('name' => $name));
    }

    // Se connecter
    public function loginAction()
    {
        if ($this->get('security.context')->isGranted('IS_AUTHENTICATED_REMEMBERED')) {
            return $this->redirect($this->generateUrl('novify_front_homepage'));
        }
        $request = $this->getRequest();
        $session = $request->getSession();

        // get the login error if there is one
        if ($request->attributes->has(SecurityContext::AUTHENTICATION_ERROR)) {
            $error = $request->attributes->get(SecurityContext::AUTHENTICATION_ERROR);
        } else {
            $error = $session->get(SecurityContext::AUTHENTICATION_ERROR);
            $session->remove(SecurityContext::AUTHENTICATION_ERROR);
        }

        return $this->render('NovifySecurityBundle:Security:login.html.twig', array(
            // last username entered by the user
            'last_username' => $session->get(SecurityContext::LAST_USERNAME),
            'error'         => $error,
        ));
    }

    // inscription
    public function inscriptionAction()
    {
        $inscription = new Utilisateurs();
        $form = $this->createForm(new SignupType(), $inscription);
        $request = $this->getRequest();
        if ($form->handleRequest($request)->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($inscription);
            $em->flush();

            // Confirmation ne flashbag (notification)
            $session = $request->getSession();
            $session->getFlashBag()->add('confirmation_inscription', 'Votre compte a bien été créé !');

            return $this->redirect($this->generateUrl('novify_front_homepage'));
        }

        return $this->render('NovifySecurityBundle:Security:inscription.html.twig', array('form' => $form->createView()));
    }
}
