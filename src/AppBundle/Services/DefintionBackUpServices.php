<?php

namespace AppBundle\Services;

use AppBundle\Entity\Definition;
use AppBundle\Entity\DefinitionBackUp;

class DefinitionBackUpServices extends BackUpServices{
    /**
     * 
     * @param Definition $definition
     */
    public function save(Definition $definition)
    {
        if($this->status){
            $backup = new DefinitionBackUp;
            $mot = $definition->getMot();
            $backup->setData( serialize($definition) );
            $backup->setDate( new \DateTime );
            $backup->setModType($this->status);
            $backup->setDefinitionId( $definition->getId() );
            
            $backup->setMotId( $mot->getId() );
            $backup->setEmail( $mot->getEmail());
            
            $this->manager->persist($backup);
            $this->manager->flush();
        } else {
            die('do stuff');
        }
    }
}

