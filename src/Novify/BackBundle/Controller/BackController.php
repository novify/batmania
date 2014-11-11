<?php

namespace Novify\BackBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Novify\ModelBundle\Entity\Articles;

class BackController extends Controller
{
    public function helloAction($name)
    {
        return $this->render('NovifyBackBundle:Back:hello.html.twig', array('name' => $name));
    }

    public function indexAction() //page d'accueil du back office
    {
        $em = $this->getDoctrine()->getManager();

        // On selectionne les 4 derniers articles ajoutés
        $articles = $em->getRepository('NovifyModelBundle:Articles')->findLastArticles(4);

        // On compte le nombre d'articles sur le site
        $query = $em->createQuery(
            'SELECT COUNT(a.id)
			FROM NovifyModelBundle:Articles a'
        );

        $nb_articles = $query->getSingleScalarResult();

        // On compte le nombre d'utilisateurs sur le site
        $query = $em->createQuery(
            'SELECT COUNT(u.id)
			FROM NovifyModelBundle:Utilisateurs u'
        );

        $nb_utilisateurs = $query->getSingleScalarResult();

        // On compte le nombre de commandes sur le site
        $query = $em->createQuery(
            'SELECT COUNT(c.id)
			FROM NovifyModelBundle:Commandes c'
        );

        $nb_commandes = $query->getSingleScalarResult();

        // On compte le nombre d'articles bientot en rupture de stock
        $query = $em->createQuery(
            'SELECT COUNT(a.id)
			FROM NovifyModelBundle:Articles a
			WHERE a.artStock <= 10'
        );

        $nb_rupt_stock = $query->getSingleScalarResult();

        // On va chercher tous les articles à la limite de la rupture de stock
        $query = $em->createQuery(
            'SELECT a
			FROM NovifyModelBundle:Articles a
			WHERE a.artStock <= 10
			ORDER BY a.artStock ASC'
        );

        $articles_rupt_stock = $query->getResult();

        // On recupere tous les prix des commandes pour calculer le CA total
        $query = $em->createQuery(
            'SELECT SUM(c.comPrix)
			FROM NovifyModelBundle:Commandes c'
        );

        $chiffre_affaire = $query->getSingleScalarResult();

        // On recupere toutes les commandes pour les afficher dans le graphique
        $query = $em->createQuery(
            'SELECT c
			FROM NovifyModelBundle:Commandes c
			ORDER BY c.comDate ASC'
        );

        $commandes_graphe = $query->getResult();

        return $this->render('NovifyBackBundle:Back:index.html.twig', array('articles' => $articles, 'nb_articles' => $nb_articles, 'nb_utilisateurs' => $nb_utilisateurs, 'nb_commandes' => $nb_commandes, 'nb_rupt_stock' => $nb_rupt_stock,'articles_rupt_stock' => $articles_rupt_stock, 'chiffre_affaire' => $chiffre_affaire, 'commandes_graphe' => $commandes_graphe));
    }
}
