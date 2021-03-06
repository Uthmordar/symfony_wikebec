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
        }
    }
    
    public function postPersist(Mot $mot, LifecycleEventArgs $event)
    {
        $this->mailer->sendCreate()->send(['mot'=>$mot]);
        $this->backuper->setCreate()->save($mot);
    }
    
    public function preUpdate(Mot $mot, LifecycleEventArgs $event)
    {
        $date = new \DateTime;
        $mot->setLastEdit($date);
    }
    
    public function postUpdate(Mot $mot, LifecycleEventArgs $event){
    
        $uw = $event->getEntityManager()->getUnitOfWork();
        $uw->computeChangeSets();
        $changes = $uw->getEntityChangeSet($mot);
        if( !array_key_exists ( 'nb_votes' , $changes ) ){
            $this->mailer->sendUpdate()->send(['mot'=>$mot,'updates'=>$changes]);
            $this->backuper->setUpdate()->save($mot);    
        }
        
        
    }
    
    public function preRemove(Mot $mot, LifecycleEventArgs $event)
    {
        $this->mailer->sendDelete()->send(['mot'=>$mot]);
        $this->backuper->setDelete()->save($mot);
    }
}