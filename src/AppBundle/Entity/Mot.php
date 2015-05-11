<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * Mot
 *
 * @ORM\Table()
 * @ORM\Entity(repositoryClass="AppBundle\Entity\MotRepository")
 * @ORM\HasLifecycleCallbacks()
 */
class Mot
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
     * @Assert\NotBlank(message="Ce champ est obligatoire")
     * @Assert\Email(message="Votre adresse mail est mal formatée")
     */
    private $email;
    
    function getEmail() {
        return $this->email;
    }

    function setEmail($email) {
        $this->email = $email;
    }

    /**
     * @var string
     *
     * @ORM\Column(name="terme", type="string", length=255)
     * @Assert\NotBlank(message="Ce champ est obligatoire")
     */
    private $terme;

    /**
     * @var string
     *
     * @ORM\Column(name="variations", type="text", nullable=true)
     */
    private $variations;

    /**
     * @var string
     *
     * @ORM\Column(name="prononciation", type="string", length=255, nullable=true)
     */
    private $prononciation;

    /**
     * @var string
     *
     * @ORM\Column(name="nature", type="string", length=255, nullable=true)
     */
    private $nature;

    /**
     * @var string
     *
     * @ORM\Column(name="genre", type="string", length=255, nullable=true)
     */
    private $genre;

    /**
     * @var integer
     * @Assert\NotBlank()
     * @ORM\Column(name="nb_votes", type="integer")
     */
    private $nb_votes = 0;

    /**
     * @var string
     *
     * @ORM\Column(name="nombre", type="string", length=255, nullable=true)
     */
    private $nombre;

    /**
     * @var string
     *
     * @ORM\Column(name="origine", type="text", nullable=true)
     */
    private $origine;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="createdDate", type="datetime", nullable=true)
     */
    private $createdDate;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="lastEdit", type="datetime", nullable=true)
     */
    private $lastEdit;
    
    /**
     * @ORM\OneToMany(targetEntity="AppBundle\Entity\Definition", mappedBy="mot", cascade={"remove", "persist"})
     */
    private $definitions;
    
    /**
     * @ORM\OneToMany(targetEntity="AppBundle\Entity\Exemple", mappedBy="mot", cascade={"remove", "persist"})
     */
    private $exemples;
    
    /**
     * @ORM\ManyToOne(targetEntity="AppBundle\Entity\Categorie", inversedBy="mot")
     */
    private $categorie;
    
    /**
     * @ORM\OneToMany(targetEntity="AppBundle\Entity\Vote", mappedBy="mot", cascade={"remove", "persist"})
     */
    private $votes;
    
    /**
     * @var string
     *
     * @ORM\Column(name="trad", type="text", nullable=true)
     */
    private $trad;


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
     * Set terme
     *
     * @param string $terme
     * @return Mot
     */
    public function setTerme($terme)
    {
        $this->terme = $terme;

        return $this;
    }

    /**
     * Get terme
     *
     * @return string 
     */
    public function getTerme()
    {
        return $this->terme;
    }

    /**
     * Set variations
     *
     * @param string $variations
     * @return Mot
     */
    public function setVariations($variations)
    {
        $this->variations = $variations;

        return $this;
    }

    /**
     * Get variations
     *
     * @return string 
     */
    public function getVariations()
    {
        return $this->variations;
    }

    /**
     * Set prononciation
     *
     * @param string $prononciation
     * @return Mot
     */
    public function setPrononciation($prononciation)
    {
        $this->prononciation = $prononciation;

        return $this;
    }

    /**
     * Get prononciation
     *
     * @return string 
     */
    public function getPrononciation()
    {
        return $this->prononciation;
    }

    /**
     * Set nature
     *
     * @param string $nature
     * @return Mot
     */
    public function setNature($nature)
    {
        $this->nature = $nature;

        return $this;
    }

    /**
     * Get nature
     *
     * @return string 
     */
    public function getNature()
    {
        return $this->nature;
    }

    /**
     * Set genre
     *
     * @param string $genre
     * @return Mot
     */
    public function setGenre($genre)
    {
        $this->genre = $genre;

        return $this;
    }

    /**
     * Get genre
     *
     * @return string 
     */
    public function getGenre()
    {
        return $this->genre;
    }

    /**
     * Set nombre
     *
     * @param string $nombre
     * @return Mot
     */
    public function setNombre($nombre)
    {
        $this->nombre = $nombre;

        return $this;
    }

    /**
     * Get nombre
     *
     * @return string 
     */
    public function getNombre()
    {
        return $this->nombre;
    }

    /**
     * Set origine
     *
     * @param string $origine
     * @return Mot
     */
    public function setOrigine($origine)
    {
        $this->origine = $origine;

        return $this;
    }

    /**
     * Get origine
     *
     * @return string 
     */
    public function getOrigine()
    {
        return $this->origine;
    }

    /**
     * Set createdDate
     *
     * @param \DateTime $createdDate
     * @return Mot
     */
    public function setCreatedDate($createdDate)
    {
        $this->createdDate = $createdDate;

        return $this;
    }

    /**
     * Get createdDate
     *
     * @return \DateTime 
     */
    public function getCreatedDate()
    {
        return $this->createdDate;
    }

    /**
     * Set lastEdit
     *
     * @param \DateTime $lastEdit
     * @return Mot
     */
    public function setLastEdit($lastEdit)
    {
        $this->lastEdit = $lastEdit;

        return $this;
    }

    /**
     * Get lastEdit
     *
     * @return \DateTime 
     */
    public function getLastEdit()
    {
        return $this->lastEdit;
    }
    /**
     * Constructor
     */
    public function __construct()
    {
        $this->definitions = new \Doctrine\Common\Collections\ArrayCollection();
        $this->exemples = new \Doctrine\Common\Collections\ArrayCollection();
        $this->votes = new \Doctrine\Common\Collections\ArrayCollection();
    }

    /**
     * Set nb_votes
     *
     * @param integer $nbVotes
     * @return Mot
     */
    public function setNbVotes($nbVotes)
    {
        $this->nb_votes = $nbVotes;

        return $this;
    }

    /**
     * Get nb_votes
     *
     * @return integer 
     */
    public function getNbVotes()
    {
        return $this->nb_votes;
    }

    /**
     * Add definitions
     *
     * @param \AppBundle\Entity\Definition $definitions
     * @return Mot
     */
    public function addDefinition(\AppBundle\Entity\Definition $definitions)
    {
        $this->definitions[] = $definitions;
        $definitions->setMot($this);
        
        return $this;
    }

    /**
     * Remove definitions
     *
     * @param \AppBundle\Entity\Definition $definitions
     */
    public function removeDefinition(\AppBundle\Entity\Definition $definitions)
    {
        $this->definitions->removeElement($definitions);
    }

    /**
     * Get definitions
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getDefinitions()
    {
        return $this->definitions;
    }

    /**
     * Add exemples
     *
     * @param \AppBundle\Entity\Exemple $exemples
     * @return Mot
     */
    public function addExemple(\AppBundle\Entity\Exemple $exemples)
    {
        $this->exemples[] = $exemples;
        $exemples->setMot($this);
        return $this;
    }

    /**
     * Remove exemples
     *
     * @param \AppBundle\Entity\Exemple $exemples
     */
    public function removeExemple(\AppBundle\Entity\Exemple $exemples)
    {
        $this->exemples->removeElement($exemples);
    }

    /**
     * Get exemples
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getExemples()
    {
        return $this->exemples;
    }

    /**
     * Set categorie
     *
     * @param \AppBundle\Entity\Categorie $categorie
     * @return Mot
     */
    public function setCategorie(\AppBundle\Entity\Categorie $categorie = null)
    {
        $this->categorie = $categorie;
        
        $categorie->addMot($this);

        return $this;
    }

    /**
     * Get categorie
     *
     * @return \AppBundle\Entity\Categorie 
     */
    public function getCategorie()
    {
        return $this->categorie;
    }

    /**
     * Add votes
     *
     * @param \AppBundle\Entity\Vote $votes
     * @return Mot
     */
    public function addVote(\AppBundle\Entity\Vote $votes)
    {
        $this->votes[] = $votes;

        return $this;
    }

    /**
     * Remove votes
     *
     * @param \AppBundle\Entity\Vote $votes
     */
    public function removeVote(\AppBundle\Entity\Vote $votes)
    {
        $this->votes->removeElement($votes);
    }

    /**
     * Get votes
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getVotes()
    {
        return $this->votes;
    }

    /**
     * Set trad
     *
     * @param string $trad
     * @return Mot
     */
    public function setTrad($trad)
    {
        $this->trad = $trad;

        return $this;
    }

    /**
     * Get trad
     *
     * @return string 
     */
    public function getTrad()
    {
        return $this->trad;
    }
    
    /**
     * @ORM\PrePersist
     */
    public function prePersistCb()
    {
        $date = new \DateTime;
        $this->setCreatedDate($date);
        $this->setLastEdit($date);
    }
    
    /**
     * @ORM\PreUpdate
     */
    public function preUpdateCb()
    {
        $date = new \DateTime;
        $this->setLastEdit($date);
    }
}   
