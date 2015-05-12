<?php
namespace AppBundle\Entity\Listener;

use AppBundle\Entity\Mot;
use Doctrine\ORM\Event\LifecycleEventArgs;

class MotListener{
    protected $mailer;
    
    public function __construct($mailer){
        $this->mailer=$mailer;
    }
    
    public function prePersist(Mot $mot, LifecycleEventArgs $event)
    {
        if ($mot->getId() === null) {
            $date = new \DateTime;
            $mot->setCreatedDate($date);
            $mot->setLastEdit($date);
            $this->mailer->sendCreate()->send(['mot'=>$mot]);
        }
    }
    
    public function preUpdate(Mot $mot, LifecycleEventArgs $event)
    {
        $date = new \DateTime;
        $this->setLastEdit($date);
        $this->mailer->sendUpdate()->send(['mot'=>$mot]);
    }
}