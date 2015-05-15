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
    
    /**
     * 
     * @return type
     */
    public function getSecret(){
        return $this->secret;
    }
    
    /**
     * 
     * @param type $token
     * @return \AppBundle\Services\reCaptchaServices
     */
    public function setToken($token){
        $this->token=$token;
        return $this;
    }
    
    /**
     * send reCaptchaRequest & get status
     * @return type
     */
    public function checkResponse(){
        return file_get_contents("https://www.google.com/recaptcha/api/siteverify?secret=" . $this->siteKey . "&response=" . $this->token . "&remoteip=" . $this->remoteIp);
    }
}

