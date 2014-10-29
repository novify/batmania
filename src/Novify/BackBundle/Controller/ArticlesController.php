<?php

namespace Novify\BackBundle\Controller;

use Novify\ModelBundle\Form\ArticlesType;
use Novify\ModelBundle\Entity\Articles;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

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

    public function editAction(Request $request, $id)
    {
        $em = $this->getDoctrine()->getManager();
        $article = $em->getRepository('NovifyModelBundle:Articles')->find($id);
        if (!$article) {
            throw new NotFoundHttpException("Cet article n'existe pas.");
        }
        $form = $this->createForm(new ArticlesType(), $article);

        if ($form->handleRequest($request)->isValid()) {
            $em->persist($article);
            $em->flush();

            return $this->redirect($this->generateUrl('novify_back_article_index'));
        }

        return $this->render('NovifyBackBundle:Articles:edit.html.twig', array('form' => $form->createView()));
    }

    public function removeAction($id)
    {
        $em = $this->getDoctrine()->getManager();
        $article = $em->getRepository('NovifyModelBundle:Articles')->find($id);
        $em->remove($article);
        $em->flush();

        return $this->render('NovifyBackBundle:Articles:remove.html.twig');
    }
}
