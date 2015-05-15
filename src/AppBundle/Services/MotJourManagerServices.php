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
    
    /**
     * select one quality Mot randomly
     * @return \AppBundle\Services\MotJourManagerServices
     */
    public function getNew(){
        $this->mot=$this->repo->findOneRandom();
        return $this;
    }
    
    /**
     * insert Mot du jour 
     * @throws \RuntimeException
     */
    public function pushWord(){
        if($this->mot==null){
            throw new \RuntimeException('You should get a new word with getNew before');
        }
        $motJour = new \AppBundle\Entity\MotDuJour();
        $manager = $this->doctrine->getManager();

        $motJour->setMotId($this->mot->getId());

        $manager->persist($motJour);
        $manager->flush();
    }
}