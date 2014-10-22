<?php

namespace Novify\FrontBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class FrontController extends Controller
{
    public function indexAction()
    {
        return $this->render('NovifyFrontBundle:Front:index.html.twig');
    }

    public function helloAction($name)
    {
        return $this->render('NovifyFrontBundle:Front:hello.html.twig', array('name' => $name));
    }
}
