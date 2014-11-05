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
     * @ORM\Column(name="art_date_sortie", type="date", nullable=true)
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
     * @ORM\Column(name="art_stock", type="integer")
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
     * @ORM\Column(name="art_img_path", type="string", length=255, nullable=true)
     */
    private $artImgPath;

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
     * @ORM\ManyToOne(targetEntity="Novify\ModelBundle\Entity\Souscategories", cascade={"persist"}, inversedBy="articles")
     */
    private $sousCategorie;

    /**
     * @var boolean
     *
     * @ORM\Column(name="art_selection", type="boolean", nullable=true)
     */
    private $artSelection;

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

    /**
     * Set artStock
     *
     * @param  integer  $artStock
     * @return Articles
     */
    public function setArtStock($artStock)
    {
        $this->artStock = $artStock;

        return $this;
    }

    /**
     * Get artStock
     *
     * @return integer
     */
    public function getArtStock()
    {
        return $this->artStock;
    }

    /**
     * Set categorie
     *
     * @param  \Novify\ModelBundle\Entity\Categories $categorie
     * @return Articles
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
     * Set sousCategorie
     *
     * @param  \Novify\ModelBundle\Entity\Souscategories $sousCategorie
     * @return Articles
     */
    public function setSousCategorie(\Novify\ModelBundle\Entity\Souscategories $sousCategorie = null)
    {
        $this->sousCategorie = $sousCategorie;

        return $this;
    }

    /**
     * Get sousCategorie
     *
     * @return \Novify\ModelBundle\Entity\Souscategories
     */
    public function getSousCategorie()
    {
        return $this->sousCategorie;
    }

    public function getAbsolutePath()
    {
        return null === $this->artImgPath ? null : $this->getUploadRootDir().'/'.$this->artImgPath;
    }

    public function getWebPath()
    {
        return null === $this->artImgPath ? null : $this->getUploadDir().'/'.$this->artImgPath;
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
        return 'uploads/images';
    }

    public function upload()
    {
        // la propriété « artImg » peut être vide si le champ n'est pas requis
        if (null === $this->artImg) {
            return;
        }

        // la méthode « move » prend comme arguments le répertoire cible et
        // le nom de fichier cible où le fichier doit être déplacé
        $this->artImg->move($this->getUploadRootDir(), $this->artImg->getClientOriginalName());

        // définit la propriété « path » comme étant le nom de fichier où vous
        // avez stocké le fichier
        $this->artImgPath = $this->artImg->getClientOriginalName();

        // « nettoie » la propriété « artImg » comme vous n'en aurez plus besoin
        $this->artImg = null;
    }

    /**
     * Set artImgPath
     *
     * @param string $artImgPath
     * @return Articles
     */
    public function setArtImgPath($artImgPath)
    {
        $this->artImgPath = $artImgPath;

        return $this;
    }

    /**
     * Get artImgPath
     *
     * @return string 
     */
    public function getArtImgPath()
    {
        return $this->artImgPath;
    }

    /**
     * Set artSelection
     *
     * @param boolean $artSelection
     * @return Articles
     */
    public function setArtSelection($artSelection)
    {
        $this->artSelection = $artSelection;

        return $this;
    }

    /**
     * Get artSelection
     *
     * @return boolean 
     */
    public function getArtSelection()
    {
        return $this->artSelection;
    }
}
