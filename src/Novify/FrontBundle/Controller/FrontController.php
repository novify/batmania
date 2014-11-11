<?php

namespace Novify\FrontBundle\Controller;

use Novify\ModelBundle\Entity\Commandes;
use Novify\ModelBundle\Entity\CommandeArticle;
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

    public function searchAction($request)
    {

        $em = $this->getDoctrine()->getManager();
        $results = $em->getRepository('NovifyModelBundle:Articles')->search($request);

        return $this->render('NovifyFrontBundle:Front:recherche.html.twig', array('articles' => $results));
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
        if (!$session->has('panier')) {
            $session->set('panier', array(
                'ids' => array(),
                'quantite' => array(),
                'prixtotal' => 0
            ));
        }

        return $this->redirect($this->generateUrl('novify_front_panier'));
    }

    public function addToPanierAction(Request $request, $id)
    {
        // vérifie si la requête est une xhr (ajax)
        if ($request->isXmlHttpRequest()) {
            $session = $request->getSession();
            $panier = $session->get('panier');
            // si l'aticle est déjà dans le panier, alors on incrémente sa quantité
            if (array_search($id, $session->get('panier/ids')) !== false) {
                $key = array_search($id, $session->get('panier/ids'));
                $quantite = $session->get('panier/quantite/'.$key);
                $panier['quantite'][$key]++;
                $session->set('panier', $panier);
            // sinon on l'y ajoute et on initialise sa quantité à 1
            } else {
                $panier['ids'][] = $id;
                $panier['quantite'][] = 1;
                // ces manières de faire correspondent à un array_push()
                // les méthodes apportées par l'AttributeBagInterface ne permettent pas de le faire, alors on est obligé d'y aller un peu salement
                $session->set('panier', $panier);
            }

            $em = $this->getDoctrine()->getManager();

            $prixtotal = 0;
            // parcourt le panier pour récupérer le prix total en additionnant celui de chaque article
            foreach ($session->get('panier/ids') as $idPanier => $idArticle) {
                if ($idArticle) {
                    $artPrix = $em->getRepository('NovifyModelBundle:Articles')->find($idArticle)->getArtPrix();
                    $prixtotal += $session->get('panier/quantite/'.$idPanier)*$artPrix;
                }
            }
            $session->set('panier/prixtotal', $prixtotal);

            return new Response();
            // par défaut, cette réponse renvoie 200 d'après le constructeur de l'objet (voir http://api.symfony.com/master/Symfony/Component/HttpFoundation/Response.html#method___construct)
        }
    }

    public function removePanierAction(Request $request, $id)
    {
        // supprime les entrées correspondant à l'article dans le panier
        $session = $request->getSession();
        // il faut chercher à quelle clé correspond la valeur de l'id
        $key = array_search($id, $session->get('panier/ids'));
        $session->remove('panier/ids/'.$key);
        $session->remove('panier/quantite/'.$key);

        $prixtotal = 0;
        // parcourt le panier pour récupérer le prix total en additionnant celui de chaque article
        foreach ($session->get('panier/ids') as $idPanier => $idArticle) {
            if ($idArticle) {
                $artPrix = $em->getRepository('NovifyModelBundle:Articles')->find($idArticle)->getArtPrix();
                $prixtotal += $session->get('panier/quantite/'.$idPanier)*$artPrix;
            }
        }

        $session->set('panier/prixtotal', $prixtotal);

        return $this->redirect($this->generateUrl('novify_front_panier'));
    }

    public function panierAction(Request $request)
    {
        $em = $this->getDoctrine()->getManager();

        // récupère 4 articles au hasard pour les suggérer en bas de page
        // récupère 4 id d'articles au hasard
        // la fonction RAND() n'est pas prise en charge par DQL (requète Doctrine), on fait donc une requète SQL
        $id = $em
            ->getConnection()
            ->query('SELECT id FROM Articles ORDER BY RAND() LIMIT 4')
            ->fetchAll()
        ;

        // récupère les articles qui correspondent aux id ci-dessus
        $suggestionAricles = $em
            ->createQueryBuilder('a')
            ->select('a')
            ->from('NovifyModelBundle:Articles', 'a')
            ->where('a.id IN(:ids)')
            ->setParameter('ids', $id)
            ->getQuery()
            ->getResult()
        ;

        $session = $request->getSession();

        // construit un tableau avec les id des articles contenus dans la session
        $articlesList = array();
        foreach ($session->get('panier/ids') as $art) {
            array_push($articlesList, $art);
        }
        $articles = $em->getRepository('NovifyModelBundle:Articles')->findById($articlesList);

        return $this->render('NovifyFrontBundle:Front:panier.html.twig', array('suggestion_articles' => $suggestionAricles, 'panier' => $articles));
    }

    public function addCommandeAction(Request $request)
    {
        $session = $request->getSession();

        // vérifie si le panier contient quelque chose avant de commander
        if ($session->get('panier/ids')) {
            $em = $this->getDoctrine()->getManager();

            $prixtotal = 0;
            // parcourt le panier pour récupérer le prix total en additionnant celui de chaque article
            foreach ($session->get('panier/ids') as $idPanier => $idArticle) {
                if ($idArticle) {
                    $artPrix = $em->getRepository('NovifyModelBundle:Articles')->find($idArticle)->getArtPrix();
                    $prixtotal += $session->get('panier/quantite/'.$idPanier)*$artPrix;
                }
            }
            $commande = new Commandes();
            $commande->setUtilisateur($this->getUser());
            $commande->setComPrix($prixtotal);

            $panier = $session->get('panier');
            $articles = $em->getRepository('NovifyModelBundle:Articles')->findById($session->get('panier/ids'));
            foreach ($articles as $key => $article) {
                $commandearticle = new CommandeArticle();
                $commandearticle->setCommande($commande);
                $commandearticle->setArticle($article);
                $commandearticle->setAchQte($session->get('panier/quantite/'.$key));
                $em->persist($commandearticle);
            }

            $em->persist($commande);
            $em->flush();

            // reset du panier
            $session = $request->getSession();
            $session->clear();
            $session->set('panier', array(
                    'ids' => array(),
                    'quantite' => array(),
                    'prixtotal' => 0
                ));
        }

        return $this->redirect($this->generateUrl('novify_front_compte'));
    }

    public function compteAction()
    {
        $user = $this->getUser();
        $em = $this->getDoctrine()->getManager();

        if (!$user) {
            throw new NotFoundHttpException("Cet utilisateur n'existe pas.");
        }
        $commandes = $em->getRepository('NovifyModelBundle:Commandes')->findByUtilisateur($user);
        $commandesarticles = $em->getRepository('NovifyModelBundle:CommandeArticle')->findByCommande($commandes);

        return $this->render('NovifyFrontBundle:Front:compte.html.twig', array('commandes' => $commandes, 'commandesarticles' => $commandesarticles));
    }

    public function showCommandeAction($commande)
    {
        $em = $this->getDoctrine()->getManager();
        $commandesarticles = $em->getRepository('NovifyModelBundle:CommandeArticle')->findByCommande($commande);

        return $this->render('NovifyFrontBundle:Front:commande.html.twig', array('commandesarticles' => $commandesarticles));

    }
    public function compteModifAction(Request $request)
    {
        $utilisateur = $this->getUser();

        $em = $this->getDoctrine()->getManager();
        if (!$utilisateur) {
            throw new NotFoundHttpException("Cet utilisateur n'existe pas.");
        }
        $form = $this->createForm(new UtilisateursType(), $utilisateur);

        // persiste les nouvelles données en bdd
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
        $suggestionAricles = $em->getRepository('NovifyModelBundle:Articles')->findBy(
            array('sousCategorie' => $souscat), // Critere
            array('id' => 'desc'), // Tri
            4, // Limite
            0 // Offset
        );

        $commentaires = $em->getRepository('NovifyModelBundle:Commentaires')->findBy(array('article' => $article));

        if (!$article) {
            throw new NotFoundHttpException("Cet article n'existe pas.");
        }

        if (!$suggestionAricles) {
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

        return $this->render('NovifyFrontBundle:Front:ficheproduit.html.twig', array('article' => $article, 'suggestion_articles' => $suggestionAricles, 'commentaires' => $commentaires, 'form' => $form->createView()));
    }
}
