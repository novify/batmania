<?php

namespace Novify\ModelBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Newsletter
 *
 * @ORM\Table()
 * @ORM\Entity(repositoryClass="Novify\ModelBundle\Entity\NewsletterRepository")
 */
class Newsletter
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
     * @ORM\Column(name="news_mail", type="string", length=255)
     */
    private $newsMail;


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
     * Set newsMail
     *
     * @param string $newsMail
     * @return Newsletter
     */
    public function setNewsMail($newsMail)
    {
        $this->newsMail = $newsMail;

        return $this;
    }

    /**
     * Get newsMail
     *
     * @return string 
     */
    public function getNewsMail()
    {
        return $this->newsMail;
    }
}
