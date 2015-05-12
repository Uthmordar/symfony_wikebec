<?php
namespace AppBundle\Entity\Listener;

use AppBundle\Entity\Mot;
use Doctrine\ORM\Event\LifecycleEventArgs;

class MotListener{
    protected $mailer;
    protected $backuper;
    
    public function __construct($mailer, $backuper){
        $this->mailer=$mailer;
        $this->backuper = $backuper;
    }
    
    public function prePersist(Mot $mot, LifecycleEventArgs $event)
    {
        if ($mot->getId() === null) {
            $date = new \DateTime;
            $mot->setCreatedDate($date);
            $mot->setLastEdit($date);
            $this->mailer->sendCreate()->send(['mot'=>$mot]);
            $this->backuper->setCreate()->save($mot);
        }
    }
    
    public function preUpdate(Mot $mot, LifecycleEventArgs $event)
    {
        $date = new \DateTime;
        // $mot->setLastEdit($date);
        $this->mailer->sendUpdate()->send(['mot'=>$mot]);
        $this->backuper->setUpdate()->save($mot);
    }
    
    public function preRemove(Mot $mot, LifecycleEventArgs $event)
    {
        $this->mailer->sendDelete()->send(['mot'=>$mot]);
        $this->backuper->setDelete()->save($mot);
    }
}