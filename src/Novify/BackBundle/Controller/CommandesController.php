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
    //     $commande = new Commandes();
    //     $form = $this->createForm(new CommandesType(), $commande);

    //     if ($form->handleRequest($request)->isValid()) {
    //         $em = $this->getDoctrine()->getManager();
    //         $em->persist($commande);
    //         $em->flush();

    //         return $this->redirect($this->generateUrl('novify_back_commande_index'));
    //     }

    //     return $this->render('NovifyBackBundle:Commandes:add.html.twig', array('form' => $form->createView()));
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
