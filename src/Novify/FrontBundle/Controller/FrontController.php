<?php

namespace Novify\FrontBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

class FrontController extends Controller
{
    public function menuAction()
    {
        $em = $this->getDoctrine()->getManager();
        // pour l'affichage du menu : récupère les catégories
        $categories = $em->getRepository('NovifyModelBundle:Categories')->findAll();

        return $this->render('NovifyFrontBundle:Front:menu.html.twig', array('categories' => $categories));
    }

    // controller appelé dans menu.html.twig pour affichier les sous catégories
    public function showMenuSousCategoriesAction($categorie)
    {
        $em = $this->getDoctrine()->getManager();
        $cat = $em->getRepository('NovifyModelBundle:Categories')->findOneBycatNom($categorie);
        $souscats = $em->getRepository('NovifyModelBundle:Souscategories')->findByCategorie($cat);
        if (!$cat) {
            throw new NotFoundHttpException("Cette catégorie n'existe pas.");
        }
        // récupère les sous catégories pour le controller qui les affiche dans le menu via un for
        return $this->render('NovifyFrontBundle:Front:menu_souscategories.html.twig', array('souscats' => $souscats, 'categorie' => $cat));
    }

    public function indexAction()
    {
        return $this->render('NovifyFrontBundle:Front:index.html.twig');
    }

    public function loginAction()
    {
        return $this->render('NovifyFrontBundle:Front:connexion.html.twig');
    }

    public function panierAction()
    {
        return $this->render('NovifyFrontBundle:Front:panier.html.twig');
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

    public function showArticlesAction($categorie, $sousCategorie)
    {
        $em = $this->getDoctrine()->getManager();
        $cat = $em->getRepository('NovifyModelBundle:Categories')->findOneBycatNom($categorie);
        $souscat = $em->getRepository('NovifyModelBundle:Souscategories')->findOneBy(array('categorie' => $cat, 'souscatNom' => $sousCategorie));
        $articles = $em->getRepository('NovifyModelBundle:Articles')->findBysousCategorie($souscat);
        if (!$souscat) {
            throw new NotFoundHttpException("Cette sous-catégorie n'existe pas.");
        }

        return $this->render('NovifyFrontBundle:Front:catalogue_articles.html.twig', array('categorie' => $cat, 'souscat' => $souscat, 'articles' => $articles));
    }

    public function viewoneAction($categorie, $sousCategorie, $id)
    {
        $em = $this->getDoctrine()->getManager();
        $cat = $em->getRepository('NovifyModelBundle:Categories')->findOneBycatNom($categorie);
        $souscat = $em->getRepository('NovifyModelBundle:Souscategories')->findOneBy(array('categorie' => $cat, 'souscatNom' => $sousCategorie));
        $article = $em->getRepository('NovifyModelBundle:Articles')->findOneBy(array('sousCategorie' => $souscat, 'id' => $id));

        if (!$article) {
            throw new NotFoundHttpException("Cet article n'existe pas.");
        }

        return $this->render('NovifyFrontBundle:Front:ficheproduit.html.twig', array('article' => $article));
    }
}
