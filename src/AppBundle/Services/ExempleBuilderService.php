<?php
namespace AppBundle\Services;

class ExempleBuilderService{
    
    private $doctrine;
    private $manager;
    private $repo;
    
    public function __construct($doctrine){
        $this->doctrine = $doctrine;
        $this->manager = $this->doctrine->getManager();
        $this->motRepo = $doctrine->getRepository("AppBundle:Exemple");
    }
    
    public function create($mot)
    {
        
    }
}