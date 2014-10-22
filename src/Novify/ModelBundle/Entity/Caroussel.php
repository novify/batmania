<?php

namespace Novify\ModelBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Caroussel
 *
 * @ORM\Table()
 * @ORM\Entity(repositoryClass="Novify\ModelBundle\Entity\CarousselRepository")
 */
class Caroussel
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
     * @ORM\Column(name="car_img", type="string", length=255)
     */
    private $carImg;

    /**
     * @var string
     *
     * @ORM\Column(name="car_lien", type="string", length=255)
     */
    private $carLien;


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
     * Set carImg
     *
     * @param string $carImg
     * @return Caroussel
     */
    public function setCarImg($carImg)
    {
        $this->carImg = $carImg;

        return $this;
    }

    /**
     * Get carImg
     *
     * @return string 
     */
    public function getCarImg()
    {
        return $this->carImg;
    }

    /**
     * Set carLien
     *
     * @param string $carLien
     * @return Caroussel
     */
    public function setCarLien($carLien)
    {
        $this->carLien = $carLien;

        return $this;
    }

    /**
     * Get carLien
     *
     * @return string 
     */
    public function getCarLien()
    {
        return $this->carLien;
    }
}
