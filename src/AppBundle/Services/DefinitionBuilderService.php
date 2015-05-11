<?php
namespace AppBundle\Services;

class DefinitionBuilderService{
    
    private $doctrine;
    private $manager;
    private $repo;
    
    public function __construct($doctrine){
        $this->doctrine = $doctrine;
        $this->manager = $this->doctrine->getManager();
        $this->motRepo = $doctrine->getRepository("AppBundle:Definition");
    }
    
    public function checkMultipleDefinitions($mot, $dataEntry)
    {
        $this->create($mot, $dataEntry['def_1']);
        if( !empty($dataEntry['def_2']) && trim($dataEntry['def_2'])!="NULL")
        {
            $this->create($mot, $dataEntry['def_2']);
        }
    }
    
    public function create($mot, $def)
    {
        $definition = new \AppBundle\Entity\Definition();
        
        $definition->setTexte($def)
                   ->setMot($mot);
        
        $this->manager->persist($definition);
    }
}