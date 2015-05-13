<?php
namespace AppBundle\Entity\Listener;

use AppBundle\Entity\Exemple;
use Doctrine\ORM\Event\LifecycleEventArgs;

class ExempleListener{
    protected $mailer;
    protected $backuper;
    
    public function __construct($mailer, $backuper){
        $this->mailer=$mailer;
        $this->backuper = $backuper;
    }
    
    public function postPersist(Exemple $exemple, LifecycleEventArgs $event)
    {
        //$this->mailer->sendCreate()->send(['mot'=>$mot]);
        $this->backuper->setCreate()->save($exemple);
    }
    
    public function postUpdate(Exemple $exemple, LifecycleEventArgs $event){
        $this->backuper->setUpdate()->save($exemple);    
    }
    
    public function preRemove(Exemple $exemple, LifecycleEventArgs $event)
    {
        //$this->mailer->sendDelete()->send(['mot'=>$mot]);
        $this->backuper->setDelete()->save($exemple);
    }
}