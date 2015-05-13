<?php

namespace AppBundle\Services;

use AppBundle\Entity\ExempleBackUp;
use AppBundle\Entity\Exemple;

class ExempleBackUpServices extends BackUpServices{
    public function save(Exemple $exemple)
    {
        if($this->status){
            $backup = new ExempleBackUp;
            $mot = $exemple->getMot();
            $backup->setData( serialize($exemple) );
            $backup->setEmail($mot->getEmail());
            $backup->setDate( new \DateTime );
            $backup->setModType($this->status);
            $backup->setMotId( $mot->getId() );
            $backup->setExempleId( $exemple->getId() );
            $this->manager->persist($backup);
            $this->manager->flush();
        } else {
            die('do stuff');
        }
    }
}
