<?php

namespace Novify\ModelBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Achats
 *
 * @ORM\Table()
 * @ORM\Entity(repositoryClass="Novify\ModelBundle\Entity\AchatsRepository")
 */
class Achats
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
     * @var integer
     *
     * @ORM\Column(name="ach_qte", type="integer")
     */
    private $achQte;


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
     * Set achQte
     *
     * @param integer $achQte
     * @return Achats
     */
    public function setAchQte($achQte)
    {
        $this->achQte = $achQte;

        return $this;
    }

    /**
     * Get achQte
     *
     * @return integer 
     */
    public function getAchQte()
    {
        return $this->achQte;
    }
}
