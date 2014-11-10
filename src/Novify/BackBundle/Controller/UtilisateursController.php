<?php

namespace Novify\BackBundle\Controller;

use Novify\ModelBundle\Form\UtilisateursType;
use Novify\ModelBundle\Entity\Utilisateurs;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

class UtilisateursController extends Controller
{
    public function helloAction($name)
    {
        return $this->render('NovifyBackBundle:Utilisateurs:hello.html.twig', array('name' => $name));
    }

    // affichage des utilisateurs
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();
        $utilisateurs = $em->getRepository('NovifyModelBundle:Utilisateurs')->findAll();

        return $this->render('NovifyBackBundle:Utilisateurs:index.html.twig', array('utilisateurs' => $utilisateurs));
    }

    // Ajouter un utilisateur
    public function addAction(Request $request)
    {
        $utilisateur = new Utilisateurs();
        $form = $this->createForm(new UtilisateursType(), $utilisateur);

        if ($form->handleRequest($request)->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($utilisateur);
            $em->flush();

            return $this->redirect($this->generateUrl('novify_back_utilisateurs_index'));
        }

        return $this->render('NovifyBackBundle:Utilisateurs:add.html.twig', array('form' => $form->createView()));
    }

    // Supprimer
    public function editAction(Request $request, $id)
    {
        $em = $this->getDoctrine()->getManager();
        $utilisateur = $em->getRepository('NovifyModelBundle:Utilisateurs')->find($id);
        if (!$utilisateur) {
            throw new NotFoundHttpException("Cet utilisateur n'existe pas");
        }
        $form = $this->createForm(new UtilisateursType(), $utilisateur);

        if ($form->handleRequest($request)->isValid()) {
            $em->persist($utilisateur);
            $em->flush();

            return $this->redirect($this->generateUrl('novify_back_utilisateurs_index'));
        }

        return $this->render('NovifyBackBundle:Utilisateurs:edit.html.twig', array('form' => $form->createView()));
    }

    public function removeAction($id)
    {
        $em = $this->getDoctrine()->getManager();
        $utilisateur = $em->getRepository('NovifyModelBundle:Utilisateurs')->find($id);
        $em->remove($utilisateur);
        $em->flush();

        return $this->redirect($this->generateUrl('novify_back_utilisateurs_index'));
    }
}
