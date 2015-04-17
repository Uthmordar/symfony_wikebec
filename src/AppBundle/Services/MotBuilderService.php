<?php
namespace AppBundle\Services;

class MotBuilderService{
    
    private $doctrine;
    private $manager;
    private $repo;
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
        $terme = $data["terme"];
        $mot = $this->motRepo->findOneByTerme($terme);
        
        if(!empty($mot)){
            // THROW EXCEPTION
        }
        
        $mot = new \AppBundle\Entity\Mot();
        
        $date = new \DateTime();
        $dateCreated = ( !empty( $data["createdDate"] ) && is_int( $data["createdDate"] ) ) ? $date->setTimestamp($data["createdDate"]) : $date;
        
        $date = new \DateTime();
        $lastEdit = ( !empty( $data["lastEdit"] ) && is_int( $data["lastEdit"] ) ) ? $date->setTimestamp($data["lastEdit"]) : $date;
        
        
        // CHECKER SI LA VALEUR EST EGALE A "NULL" OU NULL OU ""
        $mot->setTerme($terme)
            ->setTrad( $data["trad"] )
            ->setVariations( $data["variations"]!="NULL" ? $data["variations"] : null )
            ->setPrononciation( $data["prononciation"]!="NULL" ? $data["prononciation"] : null )
            ->setNature( $data["nature"]!="NULL" ? $data["nature"] : null )
            ->setGenre( $data["genre"]!="NULL" ? $data["genre"] : null )
            ->setNombre( $data["nombre"]!="NULL" ? $data["nombre"] : null )
            ->setOrigine( $data["origine"]!="NULL" ? $data["origine"] : null )
            ->setCreatedDate( $dateCreated )
            ->setLastEdit( $lastEdit )
            ->setNbVotes( $data["nb_votes"] );
        
        $cat = $this->catRepo->findOneByNom( $this->catRef[ $data["cat"] ] );
        
        if(empty($cat)){
            // THROW EXCEPTION
            return false;
        }
        
        $mot->setCategorie($cat);
        
        $this->manager->persist($mot);
    
        return $mot;
    }
}