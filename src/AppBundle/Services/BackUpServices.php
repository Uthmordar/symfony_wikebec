<?php

namespace AppBundle\Services;

abstract class BackUpServices{
    protected $doctrine;
    protected $manager;
    protected $status;

    public function __construct($doctrine){
        $this->doctrine = $doctrine;
        $this->manager = $this->doctrine->getManager();
    }
    
    /**
     * set backup type as creation
     * @return \AppBundle\Services\BackUpServices
     */
    public function setCreate()
    {
        $this->status = 'creation';
        return $this;
    }
    
    /**
     * set backup type as update
     * @return \AppBundle\Services\BackUpServices
     */
    public function setUpdate()
    {
        $this->status = 'update';
        return $this;
    }
    
    /**
     * set backup type as suppression
     * @return \AppBundle\Services\BackUpServices
     */
    public function setDelete()
    {
        $this->status = 'suppression';
        return $this;
    }
}

