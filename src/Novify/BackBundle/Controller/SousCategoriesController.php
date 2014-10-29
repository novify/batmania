<?php

namespace Novify\BackBundle\Controller;

use Novify\ModelBundle\Form\SouscategoriesType;
use Novify\ModelBundle\Entity\Souscategories;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

class SousCategoriesController extends Controller
{
    public function helloAction($name)
    {
        return $this->render('NovifyBackBundle:SousCategories:hello.html.twig', array('name' => $name));
    }

    public function indexAction()
    {
        return $this->render('NovifyBackBundle:SousCategories:index.html.twig');
    }

    public function addAction(Request $request)
    {
        $souscategorie = new Souscategories();
        $form = $this->createForm(new SouscategoriesType(), $souscategorie);

        if ($form->handleRequest($request)->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($souscategorie);
            $em->flush();

            return $this->redirect($this->generateUrl('novify_back_souscategorie_index'));
        }

        return $this->render('NovifyBackBundle:SousCategories:add.html.twig', array('form' => $form->createView()));
    }

    public function editAction(Request $request, $id)
    {
        $em = $this->getDoctrine()->getManager();
        $souscategorie = $em->getRepository('NovifyModelBundle:Souscategories')->find($id);
        if (!$souscategorie) {
            throw new NotFoundHttpException("Cette souscategorie n'existe pas.");
        }
        $form = $this->createForm(new SouscategoriesType(), $souscategorie);

        if ($form->handleRequest($request)->isValid()) {
            $em->persist($souscategorie);
            $em->flush();

            return $this->redirect($this->generateUrl('novify_back_souscategorie_index'));
        }

        return $this->render('NovifyBackBundle:SousCategories:edit.html.twig', array('form' => $form->createView()));
    }

    public function removeAction($id)
    {
        return $this->render('NovifyBackBundle:SousCategories:remove.html.twig');
    }
}
