<?php

namespace AppBundle\Services;

class MotJourManagerServices{
    protected $doctrine;
    protected $repo;
    protected $mot;
    
    public function __construct($doctrine){
        $this->doctrine=$doctrine;
        $this->repo=$this->doctrine->getRepository("AppBundle:Mot");
    }
    
    public function getNew(){
        $this->mot=$this->repo->findOneRandom();
        return $this;
    }
    
    public function pushWord(){
        $motJour = new \AppBundle\Entity\MotDuJour();
        $manager = $this->doctrine->getManager();
            
        $motJour->setMotId($this->mot->getId());
        
        $manager->persist($motJour);
        $manager->flush();
    }
}