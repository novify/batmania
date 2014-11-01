<?php

namespace Novify\ModelBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\ArrayCollection;

/**
 * Categories
 *
 * @ORM\Table()
 * @ORM\Entity(repositoryClass="Novify\ModelBundle\Entity\CategoriesRepository")
 */
class Categories
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
     * @ORM\Column(name="cat_nom", type="string", length=50)
     */
    private $catNom;

    /**
     * @var string
     *
     * @ORM\Column(name="cat_banniere", type="string", length=50, nullable=true)
     */
    private $catBanniere;

    /**
     * @ORM\OneToMany(targetEntity="Novify\ModelBundle\Entity\Souscategories", mappedBy="categorie", cascade={"remove"})
     */
    protected $sousCategories;

    public function __construct()
    {
        $this->sousCategories = new ArrayCollection();
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
     * Set catNom
     *
     * @param  string     $catNom
     * @return Categories
     */
    public function setCatNom($catNom)
    {
        $this->catNom = $catNom;

        return $this;
    }

    /**
     * Get catNom
     *
     * @return string
     */
    public function getCatNom()
    {
        return $this->catNom;
    }

    /**
     * Add sousCategories
     *
     * @param  \Novify\ModelBundle\Entity\Souscategories $sousCategories
     * @return Categories
     */
    public function addSousCategory(\Novify\ModelBundle\Entity\Souscategories $sousCategories)
    {
        $this->sousCategories[] = $sousCategories;

        return $this;
    }

    /**
     * Remove sousCategories
     *
     * @param \Novify\ModelBundle\Entity\Souscategories $sousCategories
     */
    public function removeSousCategory(\Novify\ModelBundle\Entity\Souscategories $sousCategories)
    {
        $this->sousCategories->removeElement($sousCategories);
    }

    /**
     * Get sousCategories
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getSousCategories()
    {
        return $this->sousCategories;
    }

    /**
     * Set catBanniere
     *
     * @param  string     $catBanniere
     * @return Categories
     */
    public function setCatBanniere($catBanniere)
    {
        $this->catBanniere = $catBanniere;

        return $this;
    }

    /**
     * Get catBanniere
     *
     * @return string
     */
    public function getCatBanniere()
    {
        return $this->catBanniere;
    }
}
