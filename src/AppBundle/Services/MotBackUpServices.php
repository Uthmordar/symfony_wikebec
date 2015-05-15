<?php

namespace AppBundle\Services;

use AppBundle\Entity\BackUp;
use AppBundle\Entity\Mot;

class MotBackUpServices extends BackUpServices{
    /**
     * 
     * @param Mot $mot
     */
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
            $this->manager->flush();
        } else {
            die('do stuff');
        }
    }
}
