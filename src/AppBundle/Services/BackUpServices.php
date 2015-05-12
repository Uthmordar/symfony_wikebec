<?php

namespace AppBundle\Services;
use AppBundle\Entity\BackUp;
use AppBundle\Entity\Mot;

class BackUpServices{
    protected $doctrine;
    protected $manager;
    protected $status;

    public function __construct($doctrine){
        $this->doctrine = $doctrine;
        $this->manager = $this->doctrine->getManager();
    }
    
    public function setCreate()
    {
        $this->status = 'creation';
        return $this;
    }
    
    public function setUpdate()
    {
        $this->status = 'update';
        return $this;
    }
    
    public function setDelete()
    {
        $this->status = 'suppression';
        return $this;
    }
    
    public function save(Mot $mot)
    {
        if($this->status){
            $backup = new BackUp;
            $backup->setData( serialize($mot) );
            $backup->setEmail($mot->getEmail());
            $backup->setDate( new \DateTime );
            $backup->setModType($this->status);
            $backup->setMotId( $mot->getId() );
            
            $this->manager->persist($backup);
        } else {
            die('do stuff');
        }
    }
}

