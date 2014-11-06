<?php

namespace Novify\ModelBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Commandes
 *
 * @ORM\Table()
 * @ORM\Entity(repositoryClass="Novify\ModelBundle\Entity\CommandesRepository")
 */
class Commandes
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
     * @var \DateTime
     *
     * @ORM\Column(name="com_date", type="datetime")
     */
    private $comDate;

    /**
     * @var string
     *
     * @ORM\Column(name="com_prix", type="decimal", precision=7, scale=2)
     */
    private $comPrix;

    /**
     * @ORM\ManyToOne(targetEntity="Novify\ModelBundle\Entity\Utilisateurs", cascade={"persist"})
     */
    private $utilisateur;

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
     * Set comDate
     *
     * @param  \DateTime $comDate
     * @return Commandes
     */
    public function setComDate($comDate)
    {
        $this->comDate = $comDate;

        return $this;
    }

    /**
     * Get comDate
     *
     * @return \DateTime
     */
    public function getComDate()
    {
        return $this->comDate;
    }

    /**
     * Set comPrix
     *
     * @param  string    $comPrix
     * @return Commandes
     */
    public function setComPrix($comPrix)
    {
        $this->comPrix = $comPrix;

        return $this;
    }

    /**
     * Get comPrix
     *
     * @return string
     */
    public function getComPrix()
    {
        return $this->comPrix;
    }

    /**
     * Set utilisateur
     *
     * @param \Novify\ModelBundle\Entity\Utilisateurs $utilisateur
     * @return Commandes
     */
    public function setUtilisateur(\Novify\ModelBundle\Entity\Utilisateurs $utilisateur = null)
    {
        $this->utilisateur = $utilisateur;

        return $this;
    }

    /**
     * Get utilisateur
     *
     * @return \Novify\ModelBundle\Entity\Utilisateurs 
     */
    public function getUtilisateur()
    {
        return $this->utilisateur;
    }
}
