<?php

namespace Novify\BackBundle\Controller;

use Novify\ModelBundle\Form\NewsletterType;
use Novify\ModelBundle\Entity\Newsletter;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

class NewsletterController extends Controller
{
    public function helloAction($name)
    {
        return $this->render('NovifyBackBundle:Newsletter:hello.html.twig', array('name' => $name));
    }

    public function indexAction(){
        $em = $this->getDoctrine()->getManager();
        $newsletters = $em->getRepository('NovifyModelBundle:Newsletter')->findAll();

        return $this->render('NovifyBackBundle:Newsletter:index.html.twig', array('newsletters' => $newsletters));
    }  

    public function envoiAction(Request $request)
    { 

        $em = $this->getDoctrine()->getManager();
        $query = $em->createQuery(
            'SELECT p
            FROM NovifyModelBundle:Articles p
            ORDER BY p.id ASC'
        )->setMaxResults(2);

        $articles = $query->getResult();


        $query = $em->createQuery(
            'SELECT p
            FROM NovifyModelBundle:Articles p
            WHERE p.artSelection = 1
            ORDER BY p.id DESC'
        )->setMaxResults(2);

        $selections = $query->getResult();


       // $destinataires = $em->getRepository('NovifyModelBundle:Newsletter')->findAll();

       //  foreach ($destinataires as $destinataire) {
       //      echo $destinataire['user_mail'];
       //  }

        $message = \Swift_Message::newInstance()
        ->setContentType('text/html')
        ->setSubject('Newsletter Batmania')
        ->setFrom('contact@batmania.com')
        ->setTo('maxime.emorine@hotmail.fr')

        // On traite chaque entrée une à une
        // while ($destinataires = $query->getResult())
        // {
        
        //     ->addBcc($donnees['news_mail']);
        
        // }

        ->setBody($this->renderView('NovifyBackBundle:Newsletter:email.html.twig', array('articles' => $articles, 'selections' => $selections)))
        
        ;

        if($this->get('mailer')->send($message)){
            // On affiche un petit message pour dire que le mail s'est bien envoyé
            $session = $request->getSession();
            $session->getFlashBag()->add('confirmation_newsletter', 'La newsletter a bien été envoyée.');
        }

        else{
             // On affiche un petit message pour dire que le mail s'est mal envoyé
            $session = $request->getSession();
            $session->getFlashBag()->add('confirmation_newsletter', 'Echec de l\'envoi de la newsletter');
        }


        return $this->redirect($this->generateUrl('novify_back_newsletter_index'));
    }

    public function emailAction()
    { 
        $em = $this->getDoctrine()->getManager();
        $query = $em->createQuery(
            'SELECT p
            FROM NovifyModelBundle:Articles p
            ORDER BY p.id ASC'
        )->setMaxResults(2);

        $articles = $query->getResult();

        $query = $em->createQuery(
            'SELECT p
            FROM NovifyModelBundle:Articles p
            WHERE p.artSelection = 1
            ORDER BY p.id DESC'
        )->setMaxResults(2);

        $selections = $query->getResult();


        return $this->render('NovifyBackBundle:Newsletter:email.html.twig', array('articles' => $articles, 'selections' => $selections));
    }

   
}
