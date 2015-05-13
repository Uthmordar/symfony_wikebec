<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * ExempleBackUp
 *
 * @ORM\Table()
 * @ORM\Entity(repositoryClass="AppBundle\Entity\ExempleBackUpRepository")
 */
class ExempleBackUp
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
     * 
     * @return type
     */
    function getEmail() {
        return $this->email;
    }
    
    /**
     * 
     * @param type $email
     * @return \AppBundle\Entity\ExempleBackUp
     */
    function setEmail($email) {
        $this->email = $email;
        return $this;
    }

    /**
     * @var string
     *
     * @ORM\Column(name="email", type="string", length=255)
     */
    private $email;

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
     * @ORM\Column(name="exempleId", type="string", length=255)
     */
    private $exempleId;

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
     * @return ExempleBackUp
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
     * @return ExempleBackUp
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
     * @return ExempleBackUp
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
     * Set exempleId
     *
     * @param string $exempleId
     * @return ExempleBackUp
     */
    public function setExempleId($exempleId)
    {
        $this->exempleId = $exempleId;

        return $this;
    }

    /**
     * Get exempleId
     *
     * @return string 
     */
    public function getExempleId()
    {
        return $this->exempleId;
    }

    /**
     * Set motId
     *
     * @param string $motId
     * @return ExempleBackUp
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
