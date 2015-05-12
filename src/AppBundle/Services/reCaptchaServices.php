<?php

namespace AppBundle\Services;

class reCaptchaServices{
    protected $secret;
    protected $siteKey;
    protected $token;
    protected $remoteIp;
    
    public function __construct($siteKey, $secret){
        $this->secret=$secret;
        $this->siteKey=$siteKey;
        $this->remoteIp=filter_input(INPUT_SERVER, 'REMOTE_ADDR');
    }
    
    public function getSecret(){
        return $this->secret;
    }
    
    public function setToken($token){
        $this->token=$token;
        return $this;
    }
    
    public function checkResponse(){
        return file_get_contents("https://www.google.com/recaptcha/api/siteverify?secret=" . $this->siteKey . "&response=" . $this->token . "&remoteip=" . $this->remoteIp);
    }
}

