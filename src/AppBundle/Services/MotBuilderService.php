<?php
namespace AppBundle\Services;

class MotBuilderService{
    
    private $doctrine;
    private $manager;
    
    private $motRepo;
    private $catRepo;
    private $catRef = [
        "e"=>"Expression",
        "v"=>"Vocabulaire",
        "s"=>"Sacre",
        "d"=>"Deformation"
    ];
    
    public function __construct($doctrine){
        $this->doctrine = $doctrine;
        $this->manager = $this->doctrine->getManager();
        $this->motRepo = $doctrine->getRepository("AppBundle:Mot");
        $this->catRepo = $doctrine->getRepository("AppBundle:Categorie");
    }
    
    public function create($data)
    {
        if($this->motRepo->findOneByTerme($data["terme"])){
            throw new \RuntimeException('Term already exists '.$data["terme"]);
        }
        
        $mot = new \AppBundle\Entity\Mot();
        
        $date = new \DateTime();
        $dateCreated = ( !empty( $data["createdDate"] ) && is_int( $data["createdDate"] ) ) ? $date->setTimestamp($data["createdDate"]) : $date;
        
        $date = new \DateTime();
        $lastEdit = ( !empty( $data["lastEdit"] ) && is_int( $data["lastEdit"] ) ) ? $date->setTimestamp($data["lastEdit"]) : $date;
        
        $mot->setTerme($data["terme"])
            ->setTrad( $this->checkNull($data["trad"]) )
            ->setVariations( $this->checkNull($data["variations"]) )
            ->setPrononciation( $this->checkNull($data["prononciation"]) )
            ->setNature( $this->checkNull($data["nature"]) )
            ->setGenre( $this->checkNull($data["genre"]) )
            ->setNombre( $this->checkNull($data["nombre"]) )
            ->setOrigine( $this->checkNull($data["origine"]) )
            ->setCreatedDate( $dateCreated )
            ->setLastEdit( $lastEdit )
            ->setNbVotes( $data["nb_votes"] );
        
        $this->attachCategorie($mot, $data["cat"]);

        $this->manager->persist($mot);
    
        return $mot;
    }
    
    public function checkNull($input){
        return ($input!="NULL" && $input!="")? $input : null; 
    }
    
    public function attachCategorie(\AppBundle\Entity\Mot $mot, $catName){
        $cat = $this->catRepo->findOneByNom( $this->catRef[ $catName ] );
        
        if(empty($cat)){
            throw new \RuntimeException('Term without categorie');
        }
        
        $mot->setCategorie($cat);
    }
}