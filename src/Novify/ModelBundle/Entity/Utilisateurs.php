<?php

namespace Novify\ModelBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Utilisateurs
 *
 * @ORM\Table()
 * @ORM\Entity(repositoryClass="Novify\ModelBundle\Entity\UtilisateursRepository")
 */
class Utilisateurs
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
     * @ORM\Column(name="user_mdp", type="string", length=100)
     */
    private $userMdp;

    /**
     * @var string
     *
     * @ORM\Column(name="user_mail", type="string", length=100)
     */
    private $userMail;

    /**
     * @var string
     *
     * @ORM\Column(name="user_nom", type="string", length=50)
     */
    private $userNom;

    /**
     * @var string
     *
     * @ORM\Column(name="user_prenom", type="string", length=50)
     */
    private $userPrenom;

    /**
     * @var string
     *
     * @ORM\Column(name="user_civilite", type="string", length=1)
     */
    private $userCivilite;

    /**
     * @var string
     *
     * @ORM\Column(name="user_fact_civilite", type="string", length=1)
     */
    private $userFactCivilite;

    /**
     * @var string
     *
     * @ORM\Column(name="user_fact_nom", type="string", length=50, nullable=true)
     */
    private $userFactNom;

    /**
     * @var string
     *
     * @ORM\Column(name="user_fact_prenom", type="string", length=50, nullable=true)
     */
    private $userFactPrenom;

    /**
     * @var string
     *
     * @ORM\Column(name="user_fact_societe", type="string", length=100, nullable=true)
     */
    private $userFactSociete;

    /**
     * @var string
     *
     * @ORM\Column(name="user_fact_adresse", type="string", length=300, nullable=true)
     */
    private $userFactAdresse;

    /**
     * @var string
     *
     * @ORM\Column(name="user_fact_pays", type="string", length=50, nullable=true)
     */
    private $userFactPays;

    /**
     * @var string
     *
     * @ORM\Column(name="user_fact_codep", type="string", length=5, nullable=true)
     */
    private $userFactCodep;

    /**
     * @var string
     *
     * @ORM\Column(name="user_fact_ville", type="string", length=50, nullable=true)
     */
    private $userFactVille;

    /**
     * @var string
     *
     * @ORM\Column(name="user_fact_tel", type="string", length=14, nullable=true)
     */
    private $userFactTel;

    /**
     * @var string
     *
     * @ORM\Column(name="user_liv_civilite", type="string", length=1, nullable=true)
     */
    private $userLivCivilite;

    /**
     * @var string
     *
     * @ORM\Column(name="user_liv_nom", type="string", length=50, nullable=true)
     */
    private $userLivNom;

    /**
     * @var string
     *
     * @ORM\Column(name="user_liv_prenom", type="string", length=50, nullable=true)
     */
    private $userLivPrenom;

    /**
     * @var string
     *
     * @ORM\Column(name="user_liv_societe", type="string", length=100, nullable=true)
     */
    private $userLivSociete;

    /**
     * @var string
     *
     * @ORM\Column(name="user_liv_adresse", type="string", length=300, nullable=true)
     */
    private $userLivAdresse;

    /**
     * @var string
     *
     * @ORM\Column(name="user_liv_pays", type="string", length=50, nullable=true)
     */
    private $userLivPays;

    /**
     * @var string
     *
     * @ORM\Column(name="user_liv_codep", type="string", length=5, nullable=true)
     */
    private $userLivCodep;

    /**
     * @var string
     *
     * @ORM\Column(name="user_liv_ville", type="string", length=50, nullable=true)
     */
    private $userLivVille;

    /**
     * @var string
     *
     * @ORM\Column(name="user_liv_tel", type="string", length=14, nullable=true)
     */
    private $userLivTel;


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
     * Set userMdp
     *
     * @param string $userMdp
     * @return Utilisateurs
     */
    public function setUserMdp($userMdp)
    {
        $this->userMdp = $userMdp;

        return $this;
    }

    /**
     * Get userMdp
     *
     * @return string 
     */
    public function getUserMdp()
    {
        return $this->userMdp;
    }

    /**
     * Set userMail
     *
     * @param string $userMail
     * @return Utilisateurs
     */
    public function setUserMail($userMail)
    {
        $this->userMail = $userMail;

        return $this;
    }

    /**
     * Get userMail
     *
     * @return string 
     */
    public function getUserMail()
    {
        return $this->userMail;
    }

    /**
     * Set userNom
     *
     * @param string $userNom
     * @return Utilisateurs
     */
    public function setUserNom($userNom)
    {
        $this->userNom = $userNom;

        return $this;
    }

    /**
     * Get userNom
     *
     * @return string 
     */
    public function getUserNom()
    {
        return $this->userNom;
    }

    /**
     * Set userPrenom
     *
     * @param string $userPrenom
     * @return Utilisateurs
     */
    public function setUserPrenom($userPrenom)
    {
        $this->userPrenom = $userPrenom;

        return $this;
    }

    /**
     * Get userPrenom
     *
     * @return string 
     */
    public function getUserPrenom()
    {
        return $this->userPrenom;
    }

    /**
     * Set userCivilite
     *
     * @param string $userCivilite
     * @return Utilisateurs
     */
    public function setUserCivilite($userCivilite)
    {
        $this->userCivilite = $userCivilite;

        return $this;
    }

    /**
     * Get userCivilite
     *
     * @return string 
     */
    public function getUserCivilite()
    {
        return $this->userCivilite;
    }

    /**
     * Set userFactCivilite
     *
     * @param string $userFactCivilite
     * @return Utilisateurs
     */
    public function setUserFactCivilite($userFactCivilite)
    {
        $this->userFactCivilite = $userFactCivilite;

        return $this;
    }

    /**
     * Get userFactCivilite
     *
     * @return string 
     */
    public function getUserFactCivilite()
    {
        return $this->userFactCivilite;
    }

    /**
     * Set userFactNom
     *
     * @param string $userFactNom
     * @return Utilisateurs
     */
    public function setUserFactNom($userFactNom)
    {
        $this->userFactNom = $userFactNom;

        return $this;
    }

    /**
     * Get userFactNom
     *
     * @return string 
     */
    public function getUserFactNom()
    {
        return $this->userFactNom;
    }

    /**
     * Set userFactPrenom
     *
     * @param string $userFactPrenom
     * @return Utilisateurs
     */
    public function setUserFactPrenom($userFactPrenom)
    {
        $this->userFactPrenom = $userFactPrenom;

        return $this;
    }

    /**
     * Get userFactPrenom
     *
     * @return string 
     */
    public function getUserFactPrenom()
    {
        return $this->userFactPrenom;
    }

    /**
     * Set userFactSociete
     *
     * @param string $userFactSociete
     * @return Utilisateurs
     */
    public function setUserFactSociete($userFactSociete)
    {
        $this->userFactSociete = $userFactSociete;

        return $this;
    }

    /**
     * Get userFactSociete
     *
     * @return string 
     */
    public function getUserFactSociete()
    {
        return $this->userFactSociete;
    }

    /**
     * Set userFactAdresse
     *
     * @param string $userFactAdresse
     * @return Utilisateurs
     */
    public function setUserFactAdresse($userFactAdresse)
    {
        $this->userFactAdresse = $userFactAdresse;

        return $this;
    }

    /**
     * Get userFactAdresse
     *
     * @return string 
     */
    public function getUserFactAdresse()
    {
        return $this->userFactAdresse;
    }

    /**
     * Set userFactPays
     *
     * @param string $userFactPays
     * @return Utilisateurs
     */
    public function setUserFactPays($userFactPays)
    {
        $this->userFactPays = $userFactPays;

        return $this;
    }

    /**
     * Get userFactPays
     *
     * @return string 
     */
    public function getUserFactPays()
    {
        return $this->userFactPays;
    }

    /**
     * Set userFactCodep
     *
     * @param string $userFactCodep
     * @return Utilisateurs
     */
    public function setUserFactCodep($userFactCodep)
    {
        $this->userFactCodep = $userFactCodep;

        return $this;
    }

    /**
     * Get userFactCodep
     *
     * @return string 
     */
    public function getUserFactCodep()
    {
        return $this->userFactCodep;
    }

    /**
     * Set userFactVille
     *
     * @param string $userFactVille
     * @return Utilisateurs
     */
    public function setUserFactVille($userFactVille)
    {
        $this->userFactVille = $userFactVille;

        return $this;
    }

    /**
     * Get userFactVille
     *
     * @return string 
     */
    public function getUserFactVille()
    {
        return $this->userFactVille;
    }

    /**
     * Set userFactTel
     *
     * @param string $userFactTel
     * @return Utilisateurs
     */
    public function setUserFactTel($userFactTel)
    {
        $this->userFactTel = $userFactTel;

        return $this;
    }

    /**
     * Get userFactTel
     *
     * @return string 
     */
    public function getUserFactTel()
    {
        return $this->userFactTel;
    }

    /**
     * Set userLivCivilite
     *
     * @param string $userLivCivilite
     * @return Utilisateurs
     */
    public function setUserLivCivilite($userLivCivilite)
    {
        $this->userLivCivilite = $userLivCivilite;

        return $this;
    }

    /**
     * Get userLivCivilite
     *
     * @return string 
     */
    public function getUserLivCivilite()
    {
        return $this->userLivCivilite;
    }

    /**
     * Set userLivNom
     *
     * @param string $userLivNom
     * @return Utilisateurs
     */
    public function setUserLivNom($userLivNom)
    {
        $this->userLivNom = $userLivNom;

        return $this;
    }

    /**
     * Get userLivNom
     *
     * @return string 
     */
    public function getUserLivNom()
    {
        return $this->userLivNom;
    }

    /**
     * Set userLivPrenom
     *
     * @param string $userLivPrenom
     * @return Utilisateurs
     */
    public function setUserLivPrenom($userLivPrenom)
    {
        $this->userLivPrenom = $userLivPrenom;

        return $this;
    }

    /**
     * Get userLivPrenom
     *
     * @return string 
     */
    public function getUserLivPrenom()
    {
        return $this->userLivPrenom;
    }

    /**
     * Set userLivSociete
     *
     * @param string $userLivSociete
     * @return Utilisateurs
     */
    public function setUserLivSociete($userLivSociete)
    {
        $this->userLivSociete = $userLivSociete;

        return $this;
    }

    /**
     * Get userLivSociete
     *
     * @return string 
     */
    public function getUserLivSociete()
    {
        return $this->userLivSociete;
    }

    /**
     * Set userLivAdresse
     *
     * @param string $userLivAdresse
     * @return Utilisateurs
     */
    public function setUserLivAdresse($userLivAdresse)
    {
        $this->userLivAdresse = $userLivAdresse;

        return $this;
    }

    /**
     * Get userLivAdresse
     *
     * @return string 
     */
    public function getUserLivAdresse()
    {
        return $this->userLivAdresse;
    }

    /**
     * Set userLivPays
     *
     * @param string $userLivPays
     * @return Utilisateurs
     */
    public function setUserLivPays($userLivPays)
    {
        $this->userLivPays = $userLivPays;

        return $this;
    }

    /**
     * Get userLivPays
     *
     * @return string 
     */
    public function getUserLivPays()
    {
        return $this->userLivPays;
    }

    /**
     * Set userLivCodep
     *
     * @param string $userLivCodep
     * @return Utilisateurs
     */
    public function setUserLivCodep($userLivCodep)
    {
        $this->userLivCodep = $userLivCodep;

        return $this;
    }

    /**
     * Get userLivCodep
     *
     * @return string 
     */
    public function getUserLivCodep()
    {
        return $this->userLivCodep;
    }

    /**
     * Set userLivVille
     *
     * @param string $userLivVille
     * @return Utilisateurs
     */
    public function setUserLivVille($userLivVille)
    {
        $this->userLivVille = $userLivVille;

        return $this;
    }

    /**
     * Get userLivVille
     *
     * @return string 
     */
    public function getUserLivVille()
    {
        return $this->userLivVille;
    }

    /**
     * Set userLivTel
     *
     * @param string $userLivTel
     * @return Utilisateurs
     */
    public function setUserLivTel($userLivTel)
    {
        $this->userLivTel = $userLivTel;

        return $this;
    }

    /**
     * Get userLivTel
     *
     * @return string 
     */
    public function getUserLivTel()
    {
        return $this->userLivTel;
    }
}
