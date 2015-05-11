<?php

namespace AppBundle\Entity;
use Symfony\Component\Validator\Constraints as Assert;

use Doctrine\ORM\Mapping as ORM;

/**
 * Exemple
 *
 * @ORM\Table()
 * @ORM\Entity(repositoryClass="AppBundle\Entity\ExempleRepository")
 */
class Exemple
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
     * @ORM\Column(name="texte_ca", type="text", nullable=true)
     * @Assert\NotBlank(message="Ce champ est obligatoire")
     */
    private $texteCa;

    /**
     * @var string
     *
     * @ORM\Column(name="texte_fr", type="text", nullable=true)
     * @Assert\NotBlank(message="Ce champ est obligatoire")
     */
    private $texteFr;
    
    /**
     * @ORM\ManyToOne(targetEntity="AppBundle\Entity\Mot", inversedBy="exemples")
     * @ORM\JoinColumn(name="mot_id", referencedColumnName="id", onDelete="CASCADE")
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
     * Set texteCa
     *
     * @param string $texteCa
     * @return Exemple
     */
    public function setTexteCa($texteCa)
    {
        $this->texteCa = $texteCa;

        return $this;
    }

    /**
     * Get texteCa
     *
     * @return string 
     */
    public function getTexteCa()
    {
        return $this->texteCa;
    }

    /**
     * Set texteFr
     *
     * @param string $texteFr
     * @return Exemple
     */
    public function setTexteFr($texteFr)
    {
        $this->texteFr = $texteFr;

        return $this;
    }

    /**
     * Get texteFr
     *
     * @return string 
     */
    public function getTexteFr()
    {
        return $this->texteFr;
    }

    /**
     * Set mot
     *
     * @param \AppBundle\Entity\Mot $mot
     * @return Exemple
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
