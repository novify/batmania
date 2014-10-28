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
        $souscat = $em->getRepository('NovifyModelBundle:Souscategories')->findByCategorie($cat);
        foreach ($souscat as $sc) {
            $articles = $em->getRepository('NovifyModelBundle:Articles')->findBysousCategorie($sc);
        }
        if (null === $cat) {
            throw new NotFoundHttpException("Cette catégorie n'existe pas.");
        }

        return $this->render('NovifyFrontBundle:Front:catalogue.html.twig', array('articles' => $articles));
    }

    public function viewSousCatAction($categorie, $sousCategorie)
    {
        $em = $this->getDoctrine()->getManager();
        $cat = $em->getRepository('NovifyModelBundle:Categories')->findOneBycatNom($categorie);
        $souscat = $em->getRepository('NovifyModelBundle:Souscategories')->findOneBy(array('categorie' => $cat, 'souscatNom' => $sousCategorie));
        $articles = $em->getRepository('NovifyModelBundle:Articles')->findBysousCategorie($souscat);
        if (null === $souscat) {
            throw new NotFoundHttpException("Cette sous-catégorie n'existe pas.");
        }

        return $this->render('NovifyFrontBundle:Front:catalogue.html.twig', array('articles' => $articles));
    }

    public function viewoneAction($categorie, $sousCategorie, $id)
    {
        $em = $this->getDoctrine()->getManager();
        $cat = $em->getRepository('NovifyModelBundle:Categories')->findOneBycatNom($categorie);
        $souscat = $em->getRepository('NovifyModelBundle:Souscategories')->findOneBy(array('categorie' => $cat, 'souscatNom' => $sousCategorie));
        $article = $em->getRepository('NovifyModelBundle:Articles')->findOneBy(array('sousCategorie' => $souscat, 'id' => $id));

        if (null === $article) {
            throw new NotFoundHttpException("Cet article n'existe pas.");
        }

        return $this->render('NovifyFrontBundle:Front:ficheproduit.html.twig', array('article' => $article));
    }
}
