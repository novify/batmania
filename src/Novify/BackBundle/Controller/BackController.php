<?php

namespace Novify\BackBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class BackController extends Controller
{
    public function helloAction($name)
    {
        return $this->render('NovifyBackBundle:Back:hello.html.twig', array('name' => $name));
    }

    public function indexAction()
    {
        return $this->render('NovifyBackBundle:Back:index.html.twig');
    }

    public function addAction()
    {
        return $this->render('NovifyBackBundle:Back:add.html.twig');
    }

    public function editAction()
    {
        return $this->render('NovifyBackBundle:Back:edit.html.twig');
    }

    public function removeAction()
    {
        return $this->render('NovifyBackBundle:Back:remove.html.twig');
    }
}
