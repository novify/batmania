<?php

namespace Novify\SecurityBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\Security\Core\SecurityContext;
use Symfony\Component\HttpFoundation\Request;
use Novify\ModelBundle\Entity\Utilisateurs;
use Novify\ModelBundle\Form\SignupType;

class SecurityController extends Controller
{
    public function indexAction($name)
    {
        return $this->render('NovifySecurityBundle:Default:index.html.twig', array('name' => $name));
    }

    public function loginAction()
    {
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

    public function inscriptionAction(Request $request)
    {
        $inscription = new Utilisateurs();
        $form = $this->createForm(new SignupType(), $inscription);
        if ($form->handleRequest($request)->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($inscription);
            $em->flush();

            return $this->redirect($this->generateUrl('novify_front_homepage'));
        }

        return $this->render('NovifySecurityBundle:Security:inscription.html.twig', array('form' => $form->createView()));
    }
}
