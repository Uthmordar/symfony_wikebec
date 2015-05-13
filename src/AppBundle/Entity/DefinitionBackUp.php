<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * DefinitionBackUp
 *
 * @ORM\Table()
 * @ORM\Entity(repositoryClass="AppBundle\Entity\DefinitionBackUpRepository")
 */
class DefinitionBackUp
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
     * @ORM\Column(name="email", type="string", length=255)
     */
    private $email;
    
    /**
     * 
     * @return type
     */
    function getEmail() {
        return $this->email;
    }
    
    /**
     * 
     * @param type $email
     * @return \AppBundle\Entity\DefinitionBackUp
     */
    function setEmail($email) {
        $this->email = $email;
        return $this;
    } 

    /**
     * @var string
     *
     * @ORM\Column(name="data", type="text")
     */
    private $data;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="date", type="datetime")
     */
    private $date;

    /**
     * @var string
     *
     * @ORM\Column(name="modType", type="string", length=255, columnDefinition="enum('creation', 'update', 'suppression')")
     */
    private $modType;

    /**
     * @var string
     *
     * @ORM\Column(name="definitionId", type="string", length=255)
     */
    private $definitionId;

    /**
     * @var string
     *
     * @ORM\Column(name="motId", type="string", length=255)
     */
    private $motId;


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
     * Set data
     *
     * @param string $data
     * @return DefinitionBackUp
     */
    public function setData($data)
    {
        $this->data = $data;

        return $this;
    }

    /**
     * Get data
     *
     * @return string 
     */
    public function getData()
    {
        return $this->data;
    }

    /**
     * Set date
     *
     * @param \DateTime $date
     * @return DefinitionBackUp
     */
    public function setDate($date)
    {
        $this->date = $date;

        return $this;
    }

    /**
     * Get date
     *
     * @return \DateTime 
     */
    public function getDate()
    {
        return $this->date;
    }

    /**
     * Set modtype
     *
     * @param string $modtype
     * @return DefinitionBackUp
     */
    public function setModType($modtype)
    {
        $this->modType = $modtype;

        return $this;
    }

    /**
     * Get modtype
     *
     * @return string 
     */
    public function getModType()
    {
        return $this->modType;
    }

    /**
     * Set definitionId
     *
     * @param string $definitionId
     * @return DefinitionBackUp
     */
    public function setDefinitionId($definitionId)
    {
        $this->definitionId = $definitionId;

        return $this;
    }

    /**
     * Get definitionId
     *
     * @return string 
     */
    public function getDefinitionId()
    {
        return $this->definitionId;
    }

    /**
     * Set motId
     *
     * @param string $motId
     * @return DefinitionBackUp
     */
    public function setMotId($motId)
    {
        $this->motId = $motId;

        return $this;
    }

    /**
     * Get motId
     *
     * @return string 
     */
    public function getMotId()
    {
        return $this->motId;
    }
}
