<?php

namespace Novify\BackBundle\Controller;

use Novify\ModelBundle\Form\ArticlesType;
use Novify\ModelBundle\Entity\Articles;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

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

    public function addAction(Request $request)
    {
        $article = new Articles();
        $form = $this->createForm(new ArticlesType(), $article);

        if ($form->handleRequest($request)->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($article);
            $em->flush();

            return $this->redirect($this->generateUrl('novify_back_article_index'));
        }

        return $this->render('NovifyBackBundle:Articles:add.html.twig', array('form' => $form->createView()));
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
