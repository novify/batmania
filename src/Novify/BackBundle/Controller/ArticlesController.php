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

    public function indexAction() //page d'accueil des articles du back
    {
        $em = $this->getDoctrine()->getManager();
        $articles = $em->getRepository('NovifyModelBundle:Articles')->findAll();
        //On selectionne tous les articles
        return $this->render('NovifyBackBundle:Articles:index.html.twig', array('articles' => $articles));
    }

    public function addAction(Request $request) //ajouter un article
    {
        $article = new Articles(); //Nouvelle instance de classe Articles
        $form = $this->createForm(new ArticlesType(), $article); //on génère le formulaire

        //Si la requete de validation du formulaire est valide, on upload
        if ($form->handleRequest($request)->isValid()) { 
            $em = $this->getDoctrine()->getManager();
            $article->upload();
            $em->persist($article);
            $em->flush();

            //Si tout est bon, on confirme l'ajout dans une bulle de notification grace aux flashbags
            $session = $request->getSession();
            $session->getFlashBag()->add('confirmation', "L'article a bien été ajouté.");

            return $this->redirect($this->generateUrl('novify_back_article_index'));
        }

        return $this->render('NovifyBackBundle:Articles:add.html.twig', array('form' => $form->createView()));
    }

    public function editAction(Request $request, $id) //Edit des articles
    {
        $em = $this->getDoctrine()->getManager();
        $article = $em->getRepository('NovifyModelBundle:Articles')->find($id); //On va chercher l'article séléctionné
        if (!$article) {
            throw new NotFoundHttpException("Cet article n'existe pas."); //Sécurité
        }
        $form = $this->createForm(new ArticlesType(), $article); //On génère le formulaire
    
        // Envoie dans le BDD
        if ($form->handleRequest($request)->isValid()) {
            $article->upload();
            $em->persist($article);
            $em->flush();

            // Notification en flashbag
            $session = $request->getSession();
            $session->getFlashBag()->add('confirmation', "L'article a bien été mis à jour.");

            return $this->redirect($this->generateUrl('novify_back_article_index'));
        }

        return $this->render('NovifyBackBundle:Articles:edit.html.twig', array('form' => $form->createView()));
    }

    public function commentAction(Request $request, $id) //affichage des commentaires d'un article
    {
        $em = $this->getDoctrine()->getManager();
        $article = $em->getRepository('NovifyModelBundle:Articles')->find($id);
        $commentaires = $em->getRepository('NovifyModelBundle:Commentaires')->findByArticle($article);

         if (!$commentaires) {
            throw new NotFoundHttpException("Il n'y a pas de commentaires pour cet article"); //sécurité
        }

        return $this->render('NovifyBackBundle:Articles:comment.html.twig', array('commentaires' => $commentaires));
    }

    public function removeAction($id) //supprimer un article
    {
        $em = $this->getDoctrine()->getManager();
        $article = $em->getRepository('NovifyModelBundle:Articles')->find($id);
        $em->remove($article);
        $em->flush();

        return $this->redirect($this->generateUrl('novify_back_article_index'));
    }
}
