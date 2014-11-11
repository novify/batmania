<?php

namespace Novify\BackBundle\Controller;

use Novify\ModelBundle\Form\CommandesType;
use Novify\ModelBundle\Entity\Commandes;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

class CommandesController extends Controller
{
    public function helloAction($name)
    {
        return $this->render('NovifyBackBundle:Commandes:hello.html.twig', array('name' => $name));
    }

    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();
        $commandes = $em->getRepository('NovifyModelBundle:Commandes')->findAll();

        return $this->render('NovifyBackBundle:Commandes:index.html.twig', array('commandes' => $commandes));
    }

    // public function addAction(Request $request)
    // {
    //     $em = $this->getDoctrine()->getManager();

    //     $commande = new Commandes();
    //     $commande->setUtilisateur($this->getUser());
    //     $commande->setPrix('3');

    //     $panier = $session->get('panier');
    //     $articles = $em->getRepository('NovifyModelBundle:Articles')->findById($panier);
    //     foreach ($articles as $article) {
    //         $commandearticle = new CommandeArticle();
    //         $commandearticle->setCommande($commande);
    //         $commandearticle->setArticle($article);
    //     }

    //     $em->persist($commande);
    //     $em->flush();

    //     return $this->redirect($this->generateUrl('novify_front_compte_modif'));
    // }

    // public function editAction(Request $request, $id)
    // {
    //     $em = $this->getDoctrine()->getManager();
    //     $commande = $em->getRepository('NovifyModelBundle:Commandes')->find($id);
    //     if (!$commande) {
    //         throw new NotFoundHttpException("Cette commande n'existe pas.");
    //     }
    //     $form = $this->createForm(new CommandesType(), $commande);

    //     if ($form->handleRequest($request)->isValid()) {
    //         $em->persist($commande);
    //         $em->flush();

    //         return $this->redirect($this->generateUrl('novify_back_commande_index'));
    //     }

    //     return $this->render('NovifyBackBundle:Commandes:edit.html.twig', array('form' => $form->createView()));
    // }

    // public function removeAction($id)
    // {
    //     $em = $this->getDoctrine()->getManager();
    //     $commande = $em->getRepository('NovifyModelBundle:Commandes')->find($id);
    //     $em->remove($commande);
    //     $em->flush();

    //     return $this->redirect($this->generateUrl('novify_back_commande_index'));
    // }
}
