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
     * @ORM\ManyToOne(targetEntity="Novify\ModelBundle\Entity\Commandes", cascade={"persist"})
     * @ORM\JoinColumn(nullable=false)
     */
    private $commande;

    /**
     * @ORM\ManyToOne(targetEntity="Novify\ModelBundle\Entity\Articles", cascade={"persist"})
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
}
