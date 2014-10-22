<?php

namespace Novify\BackBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class DefaultController extends Controller
{
    public function indexAction($name)
    {
        return $this->render('NovifyBackBundle:Default:index.html.twig', array('name' => $name));
    }
}
