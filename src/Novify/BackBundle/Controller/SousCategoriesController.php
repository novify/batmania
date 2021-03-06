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

    // index des sous cat
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();
        $souscategories = $em->getRepository('NovifyModelBundle:Souscategories')->findAll();

        return $this->render('NovifyBackBundle:SousCategories:index.html.twig', array('souscategories' => $souscategories));
    }

    // ajouter une sous cat
    public function addAction(Request $request)
    {
        $souscategorie = new Souscategories();
        $form = $this->createForm(new SouscategoriesType(), $souscategorie);

        if ($form->handleRequest($request)->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($souscategorie);
            $em->flush();

            $session = $request->getSession();
            $session->getFlashBag()->add('confirmation', "La sous-catégorie a bien été ajoutée.");
            return $this->redirect($this->generateUrl('novify_back_souscategorie_index'));
        }

        return $this->render('NovifyBackBundle:SousCategories:add.html.twig', array('form' => $form->createView()));
    }

    // Modifier une sous cat
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

            // validation en flashbag
            $session = $request->getSession();
            $session->getFlashBag()->add('confirmation', "La sous-catégorie a bien été mise à jour.");
            return $this->redirect($this->generateUrl('novify_back_souscategorie_index'));
        }

        return $this->render('NovifyBackBundle:SousCategories:edit.html.twig', array('form' => $form->createView()));
    }

    // Supprimer une sous cat
    public function removeAction($id)
    {
        $em = $this->getDoctrine()->getManager();
        $souscategorie = $em->getRepository('NovifyModelBundle:Souscategories')->find($id);
        $em->remove($souscategorie);
        $em->flush();

        return $this->redirect($this->generateUrl('novify_back_souscategorie_index'));
    }
}
