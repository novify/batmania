<?php

namespace Novify\FrontBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

class FrontController extends Controller
{
    public function indexAction()
    {
        return $this->render('NovifyFrontBundle:Front:index.html.twig');
    }

    public function viewAction($id)
    {
        $em = $this->getDoctrine()->getManager();
        $article = $em->getRepository('NovifyModelBundle:Articles')->find($id);

        if (null === $article) {
          throw new NotFoundHttpException("L'annonce d'id ".$id." n'existe pas.");
        }

        return $this->render('NovifyFrontBundle:Front:view.html.twig', array('article' => $article));
    }

    public function helloAction($name)
    {
        return $this->render('NovifyFrontBundle:Front:hello.html.twig', array('name' => $name));
    }
}
