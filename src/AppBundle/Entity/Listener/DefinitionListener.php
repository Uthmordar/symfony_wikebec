<?php
namespace AppBundle\Entity\Listener;

use AppBundle\Entity\Definition;
use Doctrine\ORM\Event\LifecycleEventArgs;

class DefinitionListener{
    protected $mailer;
    protected $backuper;
    
    public function __construct($mailer, $backuper){
        $this->mailer=$mailer;
        $this->backuper = $backuper;
    }
    
    public function postPersist(Definition $definition, LifecycleEventArgs $event)
    {
        //$this->mailer->sendCreate()->send(['mot'=>$mot]);
        $this->backuper->setCreate()->save($definition);
    }
    
    public function postUpdate(Definition $definition, LifecycleEventArgs $event){
    
        $this->backuper->setUpdate()->save($definition);
        
    }
    
    public function preRemove(Definition $definition, LifecycleEventArgs $event)
    {
        $this->backuper->setDelete()->save($definition);
    }
}