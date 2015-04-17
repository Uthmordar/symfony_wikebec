<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Vote
 *
 * @ORM\Table()
 * @ORM\Entity(repositoryClass="AppBundle\Entity\VoteRepository")
 */
class Vote
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
     * @ORM\Column(name="ip", type="string", length=255)
     */
    private $ip;
    
    /**
     * @ORM\ManyToOne(targetEntity="AppBundle\Entity\Mot", inversedBy="votes")
     */
    private $mot;


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
     * Set ip
     *
     * @param string $ip
     * @return Vote
     */
    public function setIp($ip)
    {
        $this->ip = $ip;

        return $this;
    }

    /**
     * Get ip
     *
     * @return string 
     */
    public function getIp()
    {
        return $this->ip;
    }

    /**
     * Set mot
     *
     * @param \AppBundle\Entity\Mot $mot
     * @return Vote
     */
    public function setMot(\AppBundle\Entity\Mot $mot = null)
    {
        $this->mot = $mot;

        return $this;
    }

    /**
     * Get mot
     *
     * @return \AppBundle\Entity\Mot 
     */
    public function getMot()
    {
        return $this->mot;
    }
}
