<?php

namespace Novify\ModelBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Commentaires
 *
 * @ORM\Table()
 * @ORM\Entity(repositoryClass="Novify\ModelBundle\Entity\CommentairesRepository")
 */
class Commentaires
{
    /**
     * @var integer
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @var string
     *
     * @ORM\Column(name="comment_texte", type="text")
     */
    private $commentTexte;

    /**
     * @var integer
     *
     * @ORM\Column(name="comment_note", type="integer")
     */
    private $commentNote;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="comment_date", type="datetime")
     */
    private $commentDate;

    /**
     * @ORM\ManyToOne(targetEntity="Novify\ModelBundle\Entity\Utilisateurs", cascade={"persist"})
     */
    private $utilisateur;

    /**
     * @ORM\ManyToOne(targetEntity="Novify\ModelBundle\Entity\Articles", cascade={"persist"})
     */
    private $article;

    public function __construct()
    {
        $this->commentDate = new \DateTime();
    }

    /**
     * Get id
     *
     * @return integer
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set commentTexte
     *
     * @param  string       $commentTexte
     * @return Commentaires
     */
    public function setCommentTexte($commentTexte)
    {
        $this->commentTexte = $commentTexte;

        return $this;
    }

    /**
     * Get commentTexte
     *
     * @return string
     */
    public function getCommentTexte()
    {
        return $this->commentTexte;
    }

    /**
     * Set commentNote
     *
     * @param  integer      $commentNote
     * @return Commentaires
     */
    public function setCommentNote($commentNote)
    {
        $this->commentNote = $commentNote;

        return $this;
    }

    /**
     * Get commentNote
     *
     * @return integer
     */
    public function getCommentNote()
    {
        return $this->commentNote;
    }

    /**
     * Set commentDate
     *
     * @param integer $commentDate
     * @return Commentaires
     */
    public function setCommentDate($commentDate)
    {
        $this->commentDate = $commentDate;

        return $this;
    }

    /**
     * Get commentDate
     *
     * @return integer 
     */
    public function getCommentDate()
    {
        return $this->commentDate;
    }

    /**
     * Set utilisateur
     *
     * @param \Novify\ModelBundle\Entity\Utilisateurs $utilisateur
     * @return Commentaires
     */
    public function setUtilisateur(\Novify\ModelBundle\Entity\Utilisateurs $utilisateur = null)
    {
        $this->utilisateur = $utilisateur;

        return $this;
    }

    /**
     * Get utilisateur
     *
     * @return \Novify\ModelBundle\Entity\Utilisateurs 
     */
    public function getUtilisateur()
    {
        return $this->utilisateur;
    }

    /**
     * Set article
     *
     * @param \Novify\ModelBundle\Entity\Articles $article
     * @return Commentaires
     */
    public function setArticle(\Novify\ModelBundle\Entity\Articles $article = null)
    {
        $this->article = $article;

        return $this;
    }

    /**
     * Get article
     *
     * @return \Novify\ModelBundle\Entity\Articles 
     */
    public function getArticle()
    {
        return $this->article;
    }
}
