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
     * @param string $commentTexte
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
     * @param integer $commentNote
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
}
