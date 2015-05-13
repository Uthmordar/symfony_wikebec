<?php

namespace AppBundle\Services\backup;

abstract class BackUpServices{
    protected $doctrine;
    protected $manager;
    protected $status;

    public function __construct($doctrine){
        $this->doctrine = $doctrine;
        $this->manager = $this->doctrine->getManager();
    }
    
    public function setCreate()
    {
        $this->status = 'creation';
        return $this;
    }
    
    public function setUpdate()
    {
        $this->status = 'update';
        return $this;
    }
    
    public function setDelete()
    {
        $this->status = 'suppression';
        return $this;
    }
}

