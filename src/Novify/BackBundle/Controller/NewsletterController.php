<?php

namespace Novify\BackBundle\Controller;

use Novify\ModelBundle\Form\NewsletterType;
use Novify\ModelBundle\Entity\Newsletter;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

class NewsletterController extends Controller
{
    public function helloAction($name)
    {
        return $this->render('NovifyBackBundle:Newsletter:hello.html.twig', array('name' => $name));
    }

    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();
        $newsletters = $em->getRepository('NovifyModelBundle:Newsletter')->findAll();

        return $this->render('NovifyBackBundle:Newsletter:index.html.twig', array('newsletters' => $newsletters));
    }

    // public function addAction(Request $request)
    // {
    //     $caroussel = new Caroussel();
    //     $form = $this->createForm(new CarousselType(), $caroussel);

    //     if ($form->handleRequest($request)->isValid()) {
    //         $em = $this->getDoctrine()->getManager();
    //         $caroussel->upload();
    //         $em->persist($caroussel);
    //         $em->flush();

    //         $session = $request->getSession();
    //         $session->getFlashBag()->add('confirmation', "La slide du carrousel a bien été ajoutée.");
    //         return $this->redirect($this->generateUrl('novify_back_caroussel_index'));
    //     }

    //     return $this->render('NovifyBackBundle:Caroussel:add.html.twig', array('form' => $form->createView()));
    // }

   
}
