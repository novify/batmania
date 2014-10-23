<?php

namespace Novify\ModelBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * CommandeArticle
 *
 * @ORM\Table()
 * @ORM\Entity(repositoryClass="Novify\ModelBundle\Entity\CommandeArticleRepository")
 */
class CommandeArticle
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
     * @var integer
     *
     * @ORM\Column(name="ach_qte", type="integer")
     */
    private $achQte;

    /**
     * @ORM\ManyToOne(targetEntity="Novify\ModelBundle\Entity\Commandes")
     * @ORM\JoinColumn(nullable=false)
     */
    private $commande;

    /**
     * @ORM\ManyToOne(targetEntity="Novify\ModelBundle\Entity\Articles")
     * @ORM\JoinColumn(nullable=false)
     */
    private $article;

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
     * Set achQte
     *
     * @param  integer         $achQte
     * @return CommandeArticle
     */
    public function setAchQte($achQte)
    {
        $this->achQte = $achQte;

        return $this;
    }

    /**
     * Get achQte
     *
     * @return integer
     */
    public function getAchQte()
    {
        return $this->achQte;
    }

    /**
     * Set commande
     *
     * @param  \Novify\ModelBundle\Entity\Commandes $commande
     * @return CommandeArticle
     */
    public function setCommande(\Novify\ModelBundle\Entity\Commandes $commande)
    {
        $this->commande = $commande;

        return $this;
    }

    /**
     * Get commande
     *
     * @return \Novify\ModelBundle\Entity\Commandes
     */
    public function getCommande()
    {
        return $this->commande;
    }

    /**
     * Set article
     *
     * @param  \Novify\ModelBundle\Entity\Articles $article
     * @return CommandeArticle
     */
    public function setArticle(\Novify\ModelBundle\Entity\Articles $article)
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
