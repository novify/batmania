<?php

namespace Novify\ModelBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Articles
 *
 * @ORM\Table()
 * @ORM\Entity(repositoryClass="Novify\ModelBundle\Entity\ArticlesRepository")
 */
class Articles
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
     * @ORM\Column(name="art_nom", type="string", length=255)
     */
    private $artNom;

    /**
     * @var string
     *
     * @ORM\Column(name="art_promo", type="decimal", nullable=true)
     */
    private $artPromo;

    /**
     * @var string
     *
     * @ORM\Column(name="art_prix", type="decimal")
     */
    private $artPrix;

    /**
     * @var string
     *
     * @ORM\Column(name="art_descript", type="text")
     */
    private $artDescript;

    /**
     * @var string
     *
     * @ORM\Column(name="art_ref", type="string", length=255)
     */
    private $artRef;

    /**
     * @var string
     *
     * @ORM\Column(name="art_auteur", type="string", length=255, nullable=true)
     */
    private $artAuteur;

    /**
     * @var string
     *
     * @ORM\Column(name="art_editeur", type="string", length=255, nullable=true)
     */
    private $artEditeur;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="art_date_sortie", type="datetime", nullable=true)
     */
    private $artDateSortie;

    /**
     * @var string
     *
     * @ORM\Column(name="art_isbn", type="string", length=255, nullable=true)
     */
    private $artIsbn;

    /**
     * @var string
     *
     * @ORM\Column(name="art_public", type="text", nullable=true)
     */
    private $artPublic;

    /**
     * @var integer
     *
     * @ORM\Column(name="art_pages", type="integer", nullable=true)
     */
    private $artPages;

    /**
     * @var integer
     *
     * @ORM\Column(name="art_stock", type="integer", nullable=true)
     */
    private $artStock;

    /**
     * @var string
     *
     * @ORM\Column(name="art_genre", type="string", length=255, nullable=true)
     */
    private $artGenre;

    /**
     * @var string
     *
     * @ORM\Column(name="art_plateforme", type="string", length=255, nullable=true)
     */
    private $artPlateforme;

    /**
     * @var string
     *
     * @ORM\Column(name="art_img", type="string", length=255, nullable=true)
     */
    private $artImg;

    /**
     * @var string
     *
     * @ORM\Column(name="art_realisat", type="string", length=255, nullable=true)
     */
    private $artRealisat;

    /**
     * @var string
     *
     * @ORM\Column(name="art_casting", type="text", nullable=true)
     */
    private $artCasting;

    /**
     * @var string
     *
     * @ORM\Column(name="art_duree", type="string", length=255, nullable=true)
     */
    private $artDuree;

    /**
     * @ORM\ManyToOne(targetEntity="Novify\ModelBundle\Entity\Categories", cascade={"persist"})
     */
    private $categorie;

    /**
     * @ORM\ManyToOne(targetEntity="Novify\ModelBundle\Entity\Souscategories", cascade={"persist"})
     */
    private $sousCategorie;

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
     * Set artNom
     *
     * @param  string   $artNom
     * @return Articles
     */
    public function setArtNom($artNom)
    {
        $this->artNom = $artNom;

        return $this;
    }

    /**
     * Get artNom
     *
     * @return string
     */
    public function getArtNom()
    {
        return $this->artNom;
    }

    /**
     * Set artPromo
     *
     * @param  string   $artPromo
     * @return Articles
     */
    public function setArtPromo($artPromo)
    {
        $this->artPromo = $artPromo;

        return $this;
    }

    /**
     * Get artPromo
     *
     * @return string
     */
    public function getArtPromo()
    {
        return $this->artPromo;
    }

    /**
     * Set artPrix
     *
     * @param  string   $artPrix
     * @return Articles
     */
    public function setArtPrix($artPrix)
    {
        $this->artPrix = $artPrix;

        return $this;
    }

    /**
     * Get artPrix
     *
     * @return string
     */
    public function getArtPrix()
    {
        return $this->artPrix;
    }

    /**
     * Set artDescript
     *
     * @param  string   $artDescript
     * @return Articles
     */
    public function setArtDescript($artDescript)
    {
        $this->artDescript = $artDescript;

        return $this;
    }

    /**
     * Get artDescript
     *
     * @return string
     */
    public function getArtDescript()
    {
        return $this->artDescript;
    }

    /**
     * Set artRef
     *
     * @param  string   $artRef
     * @return Articles
     */
    public function setArtRef($artRef)
    {
        $this->artRef = $artRef;

        return $this;
    }

    /**
     * Get artRef
     *
     * @return string
     */
    public function getArtRef()
    {
        return $this->artRef;
    }

    /**
     * Set artAuteur
     *
     * @param  string   $artAuteur
     * @return Articles
     */
    public function setArtAuteur($artAuteur)
    {
        $this->artAuteur = $artAuteur;

        return $this;
    }

    /**
     * Get artAuteur
     *
     * @return string
     */
    public function getArtAuteur()
    {
        return $this->artAuteur;
    }

    /**
     * Set artEditeur
     *
     * @param  string   $artEditeur
     * @return Articles
     */
    public function setArtEditeur($artEditeur)
    {
        $this->artEditeur = $artEditeur;

        return $this;
    }

    /**
     * Get artEditeur
     *
     * @return string
     */
    public function getArtEditeur()
    {
        return $this->artEditeur;
    }

    /**
     * Set artDateSortie
     *
     * @param  \DateTime $artDateSortie
     * @return Articles
     */
    public function setArtDateSortie($artDateSortie)
    {
        $this->artDateSortie = $artDateSortie;

        return $this;
    }

    /**
     * Get artDateSortie
     *
     * @return \DateTime
     */
    public function getArtDateSortie()
    {
        return $this->artDateSortie;
    }

    /**
     * Set artIsbn
     *
     * @param  string   $artIsbn
     * @return Articles
     */
    public function setArtIsbn($artIsbn)
    {
        $this->artIsbn = $artIsbn;

        return $this;
    }

    /**
     * Get artIsbn
     *
     * @return string
     */
    public function getArtIsbn()
    {
        return $this->artIsbn;
    }

    /**
     * Set artPublic
     *
     * @param  string   $artPublic
     * @return Articles
     */
    public function setArtPublic($artPublic)
    {
        $this->artPublic = $artPublic;

        return $this;
    }

    /**
     * Get artPublic
     *
     * @return string
     */
    public function getArtPublic()
    {
        return $this->artPublic;
    }

    /**
     * Set artPages
     *
     * @param  integer  $artPages
     * @return Articles
     */
    public function setArtPages($artPages)
    {
        $this->artPages = $artPages;

        return $this;
    }

    /**
     * Get artPages
     *
     * @return integer
     */
    public function getArtPages()
    {
        return $this->artPages;
    }

    /**
     * Set artQte
     *
     * @param  integer  $artQte
     * @return Articles
     */
    public function setArtQte($artQte)
    {
        $this->artQte = $artQte;

        return $this;
    }

    /**
     * Get artQte
     *
     * @return integer
     */
    public function getArtQte()
    {
        return $this->artQte;
    }

    /**
     * Set artGenre
     *
     * @param  string   $artGenre
     * @return Articles
     */
    public function setArtGenre($artGenre)
    {
        $this->artGenre = $artGenre;

        return $this;
    }

    /**
     * Get artGenre
     *
     * @return string
     */
    public function getArtGenre()
    {
        return $this->artGenre;
    }

    /**
     * Set artPlateforme
     *
     * @param  string   $artPlateforme
     * @return Articles
     */
    public function setArtPlateforme($artPlateforme)
    {
        $this->artPlateforme = $artPlateforme;

        return $this;
    }

    /**
     * Get artPlateforme
     *
     * @return string
     */
    public function getArtPlateforme()
    {
        return $this->artPlateforme;
    }

    /**
     * Set artImg
     *
     * @param  string   $artImg
     * @return Articles
     */
    public function setArtImg($artImg)
    {
        $this->artImg = $artImg;

        return $this;
    }

    /**
     * Get artImg
     *
     * @return string
     */
    public function getArtImg()
    {
        return $this->artImg;
    }

    /**
     * Set artRealisat
     *
     * @param  string   $artRealisat
     * @return Articles
     */
    public function setArtRealisat($artRealisat)
    {
        $this->artRealisat = $artRealisat;

        return $this;
    }

    /**
     * Get artRealisat
     *
     * @return string
     */
    public function getArtRealisat()
    {
        return $this->artRealisat;
    }

    /**
     * Set artCasting
     *
     * @param  string   $artCasting
     * @return Articles
     */
    public function setArtCasting($artCasting)
    {
        $this->artCasting = $artCasting;

        return $this;
    }

    /**
     * Get artCasting
     *
     * @return string
     */
    public function getArtCasting()
    {
        return $this->artCasting;
    }

    /**
     * Set artDuree
     *
     * @param  string   $artDuree
     * @return Articles
     */
    public function setArtDuree($artDuree)
    {
        $this->artDuree = $artDuree;

        return $this;
    }

    /**
     * Get artDuree
     *
     * @return string
     */
    public function getArtDuree()
    {
        return $this->artDuree;
    }
}
