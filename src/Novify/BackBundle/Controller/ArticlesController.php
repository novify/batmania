<?php

namespace Novify\BackBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class ArticlesController extends Controller
{
    public function helloAction($name)
    {
        return $this->render('NovifyBackBundle:Articles:hello.html.twig', array('name' => $name));
    }

    public function indexAction()
    {
        return $this->render('NovifyBackBundle:Articles:index.html.twig');
    }

    public function addAction()
    {
        return $this->render('NovifyBackBundle:Articles:add.html.twig');
    }

    public function editAction($id)
    {
        return $this->render('NovifyBackBundle:Articles:edit.html.twig');
    }

    public function removeAction($id)
    {
        return $this->render('NovifyBackBundle:Articles:remove.html.twig');
    }
}
