<?php

namespace Novify\ModelBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\ArrayCollection;

/**
 * Souscategories
 *
 * @ORM\Table()
 * @ORM\Entity(repositoryClass="Novify\ModelBundle\Entity\SouscategoriesRepository")
 */
class Souscategories
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
     * @ORM\Column(name="souscat_nom", type="string", length=50)
     */
    private $souscatNom;

    /**
     * @ORM\ManyToOne(targetEntity="Novify\ModelBundle\Entity\Categories", inversedBy="sousCategories")
     */
    protected $categorie;

    /**
     * @ORM\OneToMany(targetEntity="Novify\ModelBundle\Entity\Articles", mappedBy="sousCategorie")
     */
    protected $articles;

    public function __construct()
    {
        $this->articles = new ArrayCollection();
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
     * Set souscatNom
     *
     * @param  string         $souscatNom
     * @return Souscategories
     */
    public function setSouscatNom($souscatNom)
    {
        $this->souscatNom = $souscatNom;

        return $this;
    }

    /**
     * Get souscatNom
     *
     * @return string
     */
    public function getSouscatNom()
    {
        return $this->souscatNom;
    }

    /**
     * Set categorie
     *
     * @param \Novify\ModelBundle\Entity\Categories $categorie
     * @return Souscategories
     */
    public function setCategorie(\Novify\ModelBundle\Entity\Categories $categorie = null)
    {
        $this->categorie = $categorie;

        return $this;
    }

    /**
     * Get categorie
     *
     * @return \Novify\ModelBundle\Entity\Categories 
     */
    public function getCategorie()
    {
        return $this->categorie;
    }

    /**
     * Add articles
     *
     * @param \Novify\ModelBundle\Entity\Articles $articles
     * @return Souscategories
     */
    public function addArticle(\Novify\ModelBundle\Entity\Articles $articles)
    {
        $this->articles[] = $articles;

        return $this;
    }

    /**
     * Remove articles
     *
     * @param \Novify\ModelBundle\Entity\Articles $articles
     */
    public function removeArticle(\Novify\ModelBundle\Entity\Articles $articles)
    {
        $this->articles->removeElement($articles);
    }

    /**
     * Get articles
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getArticles()
    {
        return $this->articles;
    }
}
