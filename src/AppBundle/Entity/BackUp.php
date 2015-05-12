<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * BackUp
 *
 * @ORM\Table()
 * @ORM\Entity(repositoryClass="AppBundle\Entity\BackUpRepository")
 */
class BackUp
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
     * Set email
     *
     * @param string $email
     * @return BackUp
     */
    public function setEmail($email)
    {
        $this->email = $email;

        return $this;
    }

    /**
     * Get email
     *
     * @return string 
     */
    public function getEmail()
    {
        return $this->email;
    }

    /**
     * Set data
     *
     * @param string $data
     * @return BackUp
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
     * @return BackUp
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
     * Set modType
     *
     * @param string $modType
     * @return BackUp
     */
    public function setModType($modType)
    {
        $this->modType = $modType;

        return $this;
    }

    /**
     * Get modType
     *
     * @return string 
     */
    public function getModType()
    {
        return $this->modType;
    }

    /**
     * Set mot
     *
     * @return BackUp
     */
    public function setMotId($motId)
    {
        $this->motId = $motId;
        return $this;
    }

    /**
     * Get mot
     *
     * @return \AppBundle\Entity\Mot 
     */
    public function getMotId()
    {
        return $this->motId;
    }
}
