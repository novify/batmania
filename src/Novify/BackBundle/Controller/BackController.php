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

   
}
