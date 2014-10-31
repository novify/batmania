<?php

namespace Novify\BackBundle\Controller;

use Novify\ModelBundle\Form\CategoriesType;
use Novify\ModelBundle\Entity\Categories;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

class CategoriesController extends Controller
{
    public function helloAction($name)
    {
        return $this->render('NovifyBackBundle:Categories:hello.html.twig', array('name' => $name));
    }

    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();
        $categories = $em->getRepository('NovifyModelBundle:Categories')->findAll();

        return $this->render('NovifyBackBundle:Categories:index.html.twig', array('categories' => $categories));
    }

    public function addAction(Request $request)
    {
        $categorie = new Categories();
        $form = $this->createForm(new CategoriesType(), $categorie);

        if ($form->handleRequest($request)->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($categorie);
            $em->flush();

            return $this->redirect($this->generateUrl('novify_back_categorie_index'));
        }

        return $this->render('NovifyBackBundle:Categories:add.html.twig', array('form' => $form->createView()));
    }

    public function editAction(Request $request, $id)
    {
        $em = $this->getDoctrine()->getManager();
        $categorie = $em->getRepository('NovifyModelBundle:Categories')->find($id);
        if (!$categorie) {
            throw new NotFoundHttpException("Cette catégorie n'existe pas.");
        }
        $form = $this->createForm(new CategoriesType(), $categorie);

        if ($form->handleRequest($request)->isValid()) {
            $em->persist($categorie);
            $em->flush();

            return $this->redirect($this->generateUrl('novify_back_categorie_index'));
        }

        return $this->render('NovifyBackBundle:Categories:edit.html.twig', array('form' => $form->createView()));
    }

    public function removeAction($id)
    {
        $em = $this->getDoctrine()->getManager();
        $categorie = $em->getRepository('NovifyModelBundle:Categories')->find($id);
        $em->remove($categorie);
        $em->flush();

        return $this->redirect($this->generateUrl('novify_back_categorie_index'));
    }
}
