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
    
    /**
     * 
     * @param type $input
     * @return type
     */
    public function checkNull($input){
        return ($input!="NULL" && $input!="")? $input : null; 
    }
    
    /**
     * 
     * @param type $mot
     * @param type $data
     */
    public function create($mot, $data)
    {
        $exemple = new \AppBundle\Entity\Exemple();
        
        $exemple->setTexteFr( $this->checkNull($data["trad"]) )
                ->setTexteCa( $this->checkNull($data["exemple"]) )
                ->setMot($mot);

        $this->manager->persist($exemple);
    }
}