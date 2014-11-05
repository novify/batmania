<?php

namespace Novify\BackBundle\Controller;

use Novify\ModelBundle\Form\CarousselType;
use Novify\ModelBundle\Entity\Caroussel;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

class CarousselController extends Controller
{
    public function helloAction($name)
    {
        return $this->render('NovifyBackBundle:Caroussel:hello.html.twig', array('name' => $name));
    }

    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();
        $caroussels = $em->getRepository('NovifyModelBundle:Caroussel')->findAll();

        return $this->render('NovifyBackBundle:Caroussel:index.html.twig', array('caroussels' => $caroussels));
    }

    public function addAction(Request $request)
    {
        $caroussel = new Caroussel();
        $form = $this->createForm(new CarousselType(), $caroussel);

        if ($form->handleRequest($request)->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $caroussel->upload();
            $em->persist($caroussel);
            $em->flush();

            $session = $request->getSession();
            $session->getFlashBag()->add('confirmation', "La slide du carousel a bien été ajoutée.");
            return $this->redirect($this->generateUrl('novify_back_caroussel_index'));
        }

        return $this->render('NovifyBackBundle:Caroussel:add.html.twig', array('form' => $form->createView()));
    }

    public function editAction(Request $request, $id)
    {
        $em = $this->getDoctrine()->getManager();
        $caroussel = $em->getRepository('NovifyModelBundle:Caroussel')->find($id);
        if (!$caroussel) {
            throw new NotFoundHttpException("Cette slide du carrousel n'existe pas");
        }
        $form = $this->createForm(new CarousselType(), $caroussel);

        if ($form->handleRequest($request)->isValid()) {
            $caroussel->upload();
            $em->persist($caroussel);
            $em->flush();

            $session = $request->getSession();
            $session->getFlashBag()->add('confirmation', "La slide du carousel a bien été mise à jour.");
            return $this->redirect($this->generateUrl('novify_back_caroussel_index'));
        }

        return $this->render('NovifyBackBundle:Caroussel:edit.html.twig', array('form' => $form->createView()));
    }

    public function removeAction($id)
    {
        $em = $this->getDoctrine()->getManager();
        $caroussel = $em->getRepository('NovifyModelBundle:Caroussel')->find($id);
        $em->remove($caroussel);
        $em->flush();

        return $this->redirect($this->generateUrl('novify_back_caroussel_index'));
    }
}
