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
     * penser à enlever le nullable true pour la prod !!!!!!!!!!!!!
     * @ORM\Column(name="cat_banniere_path", type="string", length=50, nullable=true)
     */
    private $catBannierePath;

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

    // Upload d'image
    public function getAbsolutePath()
    {
        return null === $this->catBannierePath ? null : $this->getUploadRootDir().'/'.$this->catBannierePath;
    }

    public function getWebPath()
    {
        return null === $this->catBannierePath ? null : $this->getUploadDir().'/'.$this->catBannierePath;
    }

    protected function getUploadRootDir()
    {
        // le chemin absolu du répertoire où les documents uploadés doivent être sauvegardés
        return __DIR__.'/../../../../web/'.$this->getUploadDir();
    }

    protected function getUploadDir()
    {
        // on se débarrasse de « __DIR__ » afin de ne pas avoir de problème lorsqu'on affiche
        // le document/image dans la vue.
        return 'uploads/images/banniere';
    }

    public function upload()
    {
        // la propriété « catBanniere » peut être vide si le champ n'est pas requis
        if (null === $this->catBanniere) {
            return;
        }

        // la méthode « move » prend comme arguments le répertoire cible et
        // le nom de fichier cible où le fichier doit être déplacé
        $this->catBanniere->move($this->getUploadRootDir(), $this->catBanniere->getClientOriginalName());

        // définit la propriété « path » comme étant le nom de fichier où vous
        // avez stocké le fichier
        $this->catBannierePath = $this->catBanniere->getClientOriginalName();

        // « nettoie » la propriété « catBanniere » comme vous n'en aurez plus besoin
        $this->catBanniere = null;
    }

    /**
     * Set catBannierePath
     *
     * @param  string     $catBannierePath
     * @return Categories
     */
    public function setCatBannierePath($catBannierePath)
    {
        $this->catBannierePath = $catBannierePath;

        return $this;
    }

    /**
     * Get catBannierePath
     *
     * @return string
     */
    public function getCatBannierePath()
    {
        return $this->catBannierePath;
    }
}
