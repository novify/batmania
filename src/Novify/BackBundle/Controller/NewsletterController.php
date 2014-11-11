<?php

namespace Novify\BackBundle\Controller;

use Novify\ModelBundle\Entity\Newsletter;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

/**
*
*/
class NewsletterController extends Controller
{
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();
        $newsletters = $em->getRepository('NovifyModelBundle:Newsletter')->findAll();

        return $this->render('NovifyBackBundle:Newsletter:index.html.twig', array('newsletters' => $newsletters));
    }

    public function envoiAction(Request $request)
    {
        $em = $this->getDoctrine()->getManager();
        $articles = $em->getRepository('NovifyModelBundle:Articles')->findLastArticles(2);// 2 derniers articles
        $selections = $em->getRepository('NovifyModelBundle:Articles')->findLastSelections(2);// 2 dernières sélections
        $destinataires = $em->getRepository('NovifyModelBundle:Newsletter')->findRecipients();// les inscrits à la newsletter
        // voir dans les *Repository pour plus d'infos sur les requêtes

        // pour avoir un tableau avec les adresses mail des inscrits (je n'ai pas trovué d'autre solution...)
        $mails = array();
        foreach ($destinataires as $destinataire) {
            foreach ($destinataire as $mail) {
                array_push($mails, $mail);
            }
        }

        // nous avons choisi d'utiliser SwiftMailer, inclus dans Symfony2, pour gérer l'envoi de la newsletter
        $message = \Swift_Message::newInstance()
        ->setContentType('text/html')
        ->setSubject('Newsletter Batmania')
        ->setFrom('contact@batmania.com')
        ->setTo($mails)
        ->setBody($this->renderView('NovifyBackBundle:Newsletter:email.html.twig', array('articles' => $articles, 'selections' => $selections)))
        ;

        // gestion des erreurs
        if ($this->get('mailer')->send($message)) {
            // On affiche un petit message pour dire que le mail s'est bien envoyé
            $session = $request->getSession();
            $session->getFlashBag()->add('confirmation_newsletter', 'La newsletter a bien été envoyée.');
        } else {
             // On affiche un petit message pour dire que le mail s'est mal envoyé
            $session = $request->getSession();
            $session->getFlashBag()->add('confirmation_newsletter', 'Echec de l\'envoi de la newsletter');
        }

        return $this->redirect($this->generateUrl('novify_back_newsletter_index'));
    }
}
