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
     * @ORM\OneToMany(targetEntity="Novify\ModelBundle\Entity\Articles", mappedBy="categorie")
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
     * Add articles
     *
     * @param  \Novify\ModelBundle\Entity\Articles $articles
     * @return Categories
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
