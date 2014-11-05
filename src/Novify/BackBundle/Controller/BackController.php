<?php

namespace Novify\BackBundle\Controller;


use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Novify\ModelBundle\Entity\Articles;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

class BackController extends Controller
{
    public function helloAction($name)
    {
        return $this->render('NovifyBackBundle:Back:hello.html.twig', array('name' => $name));
    }

    public function indexAction()
    {
    	$em = $this->getDoctrine()->getManager();


    	// On selectionne les 4 derniers articles ajoutés
    	$query = $em->createQuery(
			'SELECT p
			FROM NovifyModelBundle:Articles p
			ORDER BY p.id DESC'
		)->setMaxResults(4);

		$articles = $query->getResult();


		// On compte le nombre d'articles sur le site
		$query = $em->createQuery(
			'SELECT COUNT(p.id)
			FROM NovifyModelBundle:Articles p'
		);

		$nb_articles = $query->getSingleScalarResult();


		// On compte le nombre d'utilisateurs sur le site
		$query = $em->createQuery(
			'SELECT COUNT(p.id)
			FROM NovifyModelBundle:Utilisateurs p'
		);

		$nb_utilisateurs = $query->getSingleScalarResult();


		// On compte le nombre de commandes sur le site
		$query = $em->createQuery(
			'SELECT COUNT(p.id)
			FROM NovifyModelBundle:Commandes p'
		);

		$nb_commandes = $query->getSingleScalarResult();


		// On compte le nombre d'articles bientot en rupture de stock
		$query = $em->createQuery(
			'SELECT COUNT(p.id)
			FROM NovifyModelBundle:Articles p
			WHERE p.artStock <= 10'
		);

		$nb_rupt_stock = $query->getSingleScalarResult();


		// On va chercher tous les articles à la limite de la rupture de stock
    	$query = $em->createQuery(
			'SELECT p
			FROM NovifyModelBundle:Articles p
			WHERE p.artStock <= 10
			ORDER BY p.artStock ASC'
		);

		$articles_rupt_stock = $query->getResult();


		// On recupere tous les prix des commandes pour calculer le CA total
		$query = $em->createQuery(
			'SELECT SUM(p.comPrix)
			FROM NovifyModelBundle:Commandes p'
		);

		$chiffre_affaire = $query->getSingleScalarResult();



    
        return $this->render('NovifyBackBundle:Back:index.html.twig', array('articles' => $articles, 'nb_articles' => $nb_articles, 'nb_utilisateurs' => $nb_utilisateurs, 'nb_commandes' => $nb_commandes, 'nb_rupt_stock' => $nb_rupt_stock,'articles_rupt_stock' => $articles_rupt_stock, 'chiffre_affaire' => $chiffre_affaire));
    }

   
}
