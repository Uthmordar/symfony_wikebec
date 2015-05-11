<?php

namespace AppBundle\Entity;
use Doctrine\Common\Collections\ArrayCollection;

class MotTEMP
{
    protected $collections;

    public function __construct()
    {
        $this->collections = new ArrayCollection();
    }
    
    public function getColelctions()
    {
        return $this->collections;
    }

    public function setCollections(ArrayCollection $forms)
    {
        $this->collections = $forms;
    }
}