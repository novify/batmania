<?php

namespace Novify\ModelBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

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
     * @param string $souscatNom
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
}
