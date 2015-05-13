<?php

namespace AppBundle\Entity;
use Symfony\Component\Validator\Constraints as Assert;
use Doctrine\ORM\Mapping as ORM;

/**
 * Definition
 *
 * @ORM\Table()
 * @ORM\Entity(repositoryClass="AppBundle\Entity\DefinitionRepository")
 * @ORM\EntityListeners({ "AppBundle\Entity\Listener\DefinitionListener" })
 * @ORM\HasLifecycleCallbacks()
 */
class Definition
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
     * @ORM\Column(name="texte", type="text")
     * @Assert\NotBlank(message="Ce champ est obligatoire")
     */
    private $texte;
    
    /**
     * @ORM\ManyToOne(targetEntity="AppBundle\Entity\Mot", inversedBy="definitions")
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
     * Set texte
     *
     * @param string $texte
     * @return Definition
     */
    public function setTexte($texte)
    {
        $this->texte = $texte;

        return $this;
    }

    /**
     * Get texte
     *
     * @return string 
     */
    public function getTexte()
    {
        return $this->texte;
    }

    /**
     * Set mot
     *
     * @param \AppBundle\Entity\Mot $mot
     * @return Definition
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
