<?php

namespace Novify\FrontBundle\Controller;

use Novify\ModelBundle\Entity\Commentaires;
use Novify\ModelBundle\Form\CommentairesType;
use Novify\ModelBundle\Entity\Newsletter;
use Novify\ModelBundle\Form\NewsletterType;
use Novify\ModelBundle\Form\UtilisateursType;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Session\Session;
use Symfony\Component\HttpFoundation\Response;

class FrontController extends Controller
{

    public function menuAction()
    {
        $em = $this->getDoctrine()->getManager();
        // pour l'affichage du menu : récupère les catégories
        $categories = $em->getRepository('NovifyModelBundle:Categories')->findAll();

        return $this->render('NovifyFrontBundle:Front:menu.html.twig', array('categories' => $categories));
    }

    public function newsletterAction(Request $request)
    {

        $newsletter_mail = new Newsletter();
        $form = $this->createForm(new NewsletterType(), $newsletter_mail, array(
            'action' => $this->generateUrl('novify_front_newsletter')
        ));

        if ($form->handleRequest($request)->isValid()) {
            $em = $this->getDoctrine()->getManager();

            $em->persist($newsletter_mail);
            $em->flush();

            $session = $request->getSession();
            $session->getFlashBag()->add('confirmation_newsletter', 'Vous êtes désormais inscrit à la newsletter.');

            return $this->redirect($this->generateUrl('novify_front_homepage'));
        }

        return $this->render('NovifyFrontBundle:Front:newsletter.html.twig', array('form' => $form->createView()));

    }


    public function indexAction()
    {

        $em = $this->getDoctrine()->getManager();
        $caroussels = $em->getRepository('NovifyModelBundle:Caroussel')->findAll();

        return $this->render('NovifyFrontBundle:Front:index.html.twig', array('caroussels' => $caroussels));

    }

    public function nouveauteAction()
    {
        $em = $this->getDoctrine()->getManager();

        // On selectionne les 4 derniers articles ajoutés
        $query = $em->createQuery(
            'SELECT p
            FROM NovifyModelBundle:Articles p
            ORDER BY p.id DESC'
        )->setMaxResults(8);

        $nouveautes = $query->getResult();

        if (!$nouveautes) {
            throw new NotFoundHttpException("Il n'y a pas de nouveautes");
        }

        return $this->render('NovifyFrontBundle:Front:nouveaute.html.twig', array('nouveautes' => $nouveautes));
    }

    public function topAction()
    {
        $em = $this->getDoctrine()->getManager();

        // On selectionne les 8 articles en top
        $query = $em->createQuery(
            'SELECT p
            FROM NovifyModelBundle:Articles p
            ORDER BY p.artDescript DESC'
        )->setMaxResults(8);

        $tops = $query->getResult();

        if (!$tops) {
            throw new NotFoundHttpException("Il n'y a pas de tops des ventes");
        }

        return $this->render('NovifyFrontBundle:Front:top.html.twig', array('tops' => $tops));
    }

    public function promoAction()
    {
        $em = $this->getDoctrine()->getManager();

        $query = $em->createQuery(
            'SELECT p
            FROM NovifyModelBundle:Articles p
            WHERE p.artPromo IS NOT NULL
            ORDER BY p.id DESC'
        );

        $promos = $query->getResult();

        if (!$promos) {
            throw new NotFoundHttpException("Il n'y a pas de promos actuellement");
        }

        return $this->render('NovifyFrontBundle:Front:promo.html.twig', array('promos' => $promos));
    }

    public function selectionAction()
    {
        $em = $this->getDoctrine()->getManager();

        $query = $em->createQuery(
            'SELECT p
            FROM NovifyModelBundle:Articles p
            WHERE p.artSelection = 1'
        );

        $selections = $query->getResult();

        if (!$selections) {
            throw new NotFoundHttpException("Il n'y a pas d'articles dans la selection actuellement");
        }

        return $this->render('NovifyFrontBundle:Front:selection.html.twig', array('selections' => $selections));
    }

    public function resetPanierAction(Request $request)
    {
        $session = $request->getSession();
        $session->clear();

        return $this->redirect($this->generateUrl('novify_front_panier'));
    }

    public function addToPanierAction(Request $request, $id)
    {
        if ($request->isXmlHttpRequest()) {
            $session = $request->getSession();
            // $num = max(array_keys($session->get('panier')))+1;
            $session->set('panier/'.$id, $id);

            return new Response();
        }
    }

    public function removePanierAction(Request $request, $id)
    {
        $session = $request->getSession();
        $session->remove('panier/'.$id);

        return $this->redirect($this->generateUrl('novify_front_panier'));
    }

    public function panierAction(Request $request)
    {
        $em = $this->getDoctrine()->getManager();
        
        $query = $em->createQuery(
            'SELECT p
            FROM NovifyModelBundle:Articles p
            ORDER BY p.artNom DESC'
        )->setMaxResults(4);

        $suggestion_articles = $query->getResult();


        $session = $request->getSession();
        // $session->set('panier', $panier);
        $panier = $session->get('panier');
        // foreach ($arts as $art) {
        //     $arts = $art;
        // }
        $articles = $em->getRepository('NovifyModelBundle:Articles')->findById($panier);
        // $art = array_combine(array_keys($arts), $articles);
        return $this->render('NovifyFrontBundle:Front:panier.html.twig', array('suggestion_articles' => $suggestion_articles, 'panier' => $articles));
    }

    public function compteAction()
    {
        $user = $this->getUser();

        if (!$user) {
            throw new NotFoundHttpException("Cet utilisateur n'existe pas.");
        }

        return $this->render('NovifyFrontBundle:Front:compte.html.twig');
    }

    public function compteModifAction(Request $request)
    {

        $utilisateur = $this->getUser();

        $em = $this->getDoctrine()->getManager();
        if (!$utilisateur) {
            throw new NotFoundHttpException("Cet utilisateur n'existe pas.");
        }
        $form = $this->createForm(new UtilisateursType(), $utilisateur);

        if ($form->handleRequest($request)->isValid()) {
            $em->persist($utilisateur);
            $em->flush();

            $session = $request->getSession();
            $session->getFlashBag()->add('modif_compte', 'Votre compte a bien été modifié');

            return $this->redirect($this->generateUrl('novify_front_compte'));
        }

        return $this->render('NovifyFrontBundle:Front:compte_modif.html.twig', array('form' => $form->createView()));
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
            $commentaire->setArticle($article);
            $commentaire->setUtilisateur($this->getUser());
            $em->persist($commentaire);
            $em->flush();

            $session = $request->getSession();
            $session->getFlashBag()->add('modif_compte', 'Votre commentaire a bien été ajouté');
        }

        return $this->render('NovifyFrontBundle:Front:ficheproduit.html.twig', array('article' => $article, 'suggestion_articles' => $suggestion_articles, 'commentaires' => $commentaires, 'form' => $form->createView()));
    }
}
