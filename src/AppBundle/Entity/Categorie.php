<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Categorie
 *
 * @ORM\Table()
 * @ORM\Entity(repositoryClass="AppBundle\Entity\CategorieRepository")
 */
class Categorie
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
     * @ORM\Column(name="nom", type="string", length=255)
     */
    private $nom;
    
    /**
     * @ORM\OneToMany(targetEntity="AppBundle\Entity\Mot", mappedBy="categorie", cascade={"remove", "persist"})
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
     * Set nom
     *
     * @param string $nom
     * @return Categorie
     */
    public function setNom($nom)
    {
        $this->nom = $nom;

        return $this;
    }

    /**
     * Get nom
     *
     * @return string 
     */
    public function getNom()
    {
        return $this->nom;
    }
    /**
     * Constructor
     */
    public function __construct()
    {
        $this->mot = new \Doctrine\Common\Collections\ArrayCollection();
    }

    /**
     * Add mot
     *
     * @param \AppBundle\Entity\Mot $mot
     * @return Categorie
     */
    public function addMot(\AppBundle\Entity\Mot $mot)
    {
        $this->mot[] = $mot;

        return $this;
    }

    /**
     * Remove mot
     *
     * @param \AppBundle\Entity\Mot $mot
     */
    public function removeMot(\AppBundle\Entity\Mot $mot)
    {
        $this->mot->removeElement($mot);
    }

    /**
     * Get mot
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getMot()
    {
        return $this->mot;
    }
}
