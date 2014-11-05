<?php

namespace Novify\BackBundle\Controller;

use Novify\ModelBundle\Form\ArticlesType;
use Novify\ModelBundle\Entity\Articles;
use Novify\ModelBundle\Entity\Commentaires;
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
        $em = $this->getDoctrine()->getManager();
        $articles = $em->getRepository('NovifyModelBundle:Articles')->findAll();

        return $this->render('NovifyBackBundle:Articles:index.html.twig', array('articles' => $articles));
    }

    public function addAction(Request $request)
    {
        $article = new Articles();
        $form = $this->createForm(new ArticlesType(), $article);

        if ($form->handleRequest($request)->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $article->upload();
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
            $article->upload();
            $em->persist($article);
            $em->flush();

            return $this->redirect($this->generateUrl('novify_back_article_index'));
        }

        return $this->render('NovifyBackBundle:Articles:edit.html.twig', array('form' => $form->createView()));
    }

    public function commentAction(Request $request, $id)
    {
        $em = $this->getDoctrine()->getManager();
        $article = $em->getRepository('NovifyModelBundle:Articles')->find($id);
        $commentaires = $em->getRepository('NovifyModelBundle:Commentaires')->findByArticle($article);

         if (!$commentaires) {
            throw new NotFoundHttpException("Il n'y a pas de commentaires pour cet article");
        }
    
        return $this->render('NovifyBackBundle:Articles:comment.html.twig', array('commentaires' => $commentaires));
    }

    public function removeAction($id)
    {
        $em = $this->getDoctrine()->getManager();
        $article = $em->getRepository('NovifyModelBundle:Articles')->find($id);
        $em->remove($article);
        $em->flush();

        return $this->redirect($this->generateUrl('novify_back_article_index'));
    }
}
