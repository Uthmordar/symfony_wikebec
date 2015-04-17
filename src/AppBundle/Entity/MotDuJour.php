<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * MotDuJour
 *
 * @ORM\Table()
 * @ORM\Entity(repositoryClass="AppBundle\Entity\MotDuJourRepository")
 */
class MotDuJour
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
     * @ORM\Column(name="mot_id", type="integer")
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
     * Set motId
     *
     * @param integer $motId
     * @return MotDuJour
     */
    public function setMotId($motId)
    {
        $this->motId = $motId;

        return $this;
    }

    /**
     * Get motId
     *
     * @return integer 
     */
    public function getMotId()
    {
        return $this->motId;
    }
}
