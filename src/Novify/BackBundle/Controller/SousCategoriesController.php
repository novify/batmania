<?php

namespace Novify\BackBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

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

    public function addAction()
    {
        return $this->render('NovifyBackBundle:SousCategories:add.html.twig');
    }

    public function editAction($id)
    {
        return $this->render('NovifyBackBundle:SousCategories:edit.html.twig');
    }

    public function removeAction($id)
    {
        return $this->render('NovifyBackBundle:SousCategories:remove.html.twig');
    }
}
