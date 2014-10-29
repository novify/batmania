<?php

namespace Novify\BackBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class CategoriesController extends Controller
{
    public function helloAction($name)
    {
        return $this->render('NovifyBackBundle:Categories:hello.html.twig', array('name' => $name));
    }

    public function indexAction()
    {
        return $this->render('NovifyBackBundle:Categories:index.html.twig');
    }

    public function addAction()
    {
        return $this->render('NovifyBackBundle:Categories:add.html.twig');
    }

    public function editAction($id)
    {
        return $this->render('NovifyBackBundle:Categories:edit.html.twig');
    }

    public function removeAction($id)
    {
        return $this->render('NovifyBackBundle:Categories:remove.html.twig');
    }
}
