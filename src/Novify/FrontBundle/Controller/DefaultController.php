<?php

namespace Novify\FrontBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class DefaultController extends Controller
{
    public function indexAction($name)
    {
        return $this->render('NovifyFrontBundle:Default:index.html.twig', array('name' => $name));
    }
}
