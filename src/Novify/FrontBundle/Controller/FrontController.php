<?php

namespace Novify\FrontBundle\Controller;

use Novify\ModelBundle\Entity\Commentaires;
use Novify\ModelBundle\Form\CommentairesType;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use Symfony\Component\HttpFoundation\Request;

class FrontController extends Controller
{
    public function menuAction()
    {
        $em = $this->getDoctrine()->getManager();
        // pour l'affichage du menu : récupère les catégories
        $categories = $em->getRepository('NovifyModelBundle:Categories')->findAll();

        return $this->render('NovifyFrontBundle:Front:menu.html.twig', array('categories' => $categories));
    }

    public function indexAction()
    {

        $em = $this->getDoctrine()->getManager();
        $caroussels = $em->getRepository('NovifyModelBundle:Caroussel')->findAll();

        return $this->render('NovifyFrontBundle:Front:index.html.twig', array('caroussels' => $caroussels));

    }

    public function loginAction()
    {
        return $this->render('NovifyFrontBundle:Front:connexion.html.twig');
    }

    public function panierAction()
    {
        // A faire fonctionner

        $em = $this->getDoctrine()->getManager();
        $suggestion_articles = $em->getRepository('NovifyModelBundle:Articles')->findBy(
            array('sousCategorie' => ''), // Critere
            array('id' => 'desc'), // Tri
            4, // Limite
            0 // Offset
        );

        return $this->render('NovifyFrontBundle:Front:panier.html.twig', array('suggestion_articles' => $suggestion_articles));
    }

    public function compteAction()
    {
        $user = $this->getUser();

        if (!$user) {
            throw new NotFoundHttpException("Cet utilisateur n'existe pas.");
        }

        return $this->render('NovifyFrontBundle:Front:compte.html.twig');
    }

    public function compteModifAction()
    {
        return $this->render('NovifyFrontBundle:Front:compte_modif.html.twig');
    }

    public function contactAction()
    {
        return $this->render('NovifyFrontBundle:Front:contact.html.twig');
    }

    public function ficheAction()
    {
        return $this->render('NovifyFrontBundle:Front:ficheproduit.html.twig');
    }

    public function helloAction($name)
    {
        return $this->render('NovifyFrontBundle:Front:hello.html.twig', array('name' => $name));
    }

    public function viewCatAction($categorie)
    {
        $em = $this->getDoctrine()->getManager();
        $cat = $em->getRepository('NovifyModelBundle:Categories')->findOneBycatNom($categorie);
        $souscats = $em->getRepository('NovifyModelBundle:Souscategories')->findByCategorie($cat);
        if (!$cat) {
            throw new NotFoundHttpException("Cette catégorie n'existe pas.");
        }

        return $this->render('NovifyFrontBundle:Front:catalogue.html.twig', array('souscats' => $souscats, 'categorie' => $cat));
    }

    public function viewSousCatAction($categorie, $sousCategorie)
    {
        $em = $this->getDoctrine()->getManager();
        $cat = $em->getRepository('NovifyModelBundle:Categories')->findOneBycatNom($categorie);
        $souscat = $em->getRepository('NovifyModelBundle:Souscategories')->findBy(array('categorie' => $cat, 'souscatNom' => $sousCategorie));
        $articles = $em->getRepository('NovifyModelBundle:Articles')->findBysousCategorie($souscat);
        if (!$souscat) {
            throw new NotFoundHttpException("Cette sous-catégorie n'existe pas.");
        }

        return $this->render('NovifyFrontBundle:Front:catalogue.html.twig', array('categorie' => $cat, 'souscats' => $souscat));
    }

    public function viewoneAction(Request $request, $categorie, $sousCategorie, $id)
    {
        $em = $this->getDoctrine()->getManager();
        $cat = $em->getRepository('NovifyModelBundle:Categories')->findOneBycatNom($categorie);
        $souscat = $em->getRepository('NovifyModelBundle:Souscategories')->findOneBy(array('categorie' => $cat, 'souscatNom' => $sousCategorie));
        $article = $em->getRepository('NovifyModelBundle:Articles')->findOneBy(array('sousCategorie' => $souscat, 'id' => $id));
        $suggestion_articles = $em->getRepository('NovifyModelBundle:Articles')->findBy(
            array('sousCategorie' => $souscat), // Critere
            array('id' => 'desc'), // Tri
            4, // Limite
            0 // Offset
        );

        $commentaires = $em->getRepository('NovifyModelBundle:Commentaires')->findBy(array('article' => $article));

        if (!$article) {
            throw new NotFoundHttpException("Cet article n'existe pas.");
        }

        if (!$suggestion_articles) {
            throw new NotFoundHttpException("Cet article suggeré n'existe pas.");
        }

        $commentaire = new Commentaires();
        $form = $this->createForm(new CommentairesType(), $commentaire);
        if ($form->handleRequest($request)->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($commentaire);
            $em->flush();

            return $this->redirect($this->generateUrl('novify_front_view_fiche'));
        }

        return $this->render('NovifyFrontBundle:Front:ficheproduit.html.twig', array('article' => $article, 'suggestion_articles' => $suggestion_articles, 'commentaires' => $commentaires, 'form' => $form->createView()));
    }
}
