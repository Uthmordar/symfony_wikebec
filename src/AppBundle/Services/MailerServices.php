<?php

namespace AppBundle\Services;

use Symfony\Component\Templating\EngineInterface;

class MailerServices{
    protected $mailer;
    protected $template;
    protected $to;
    protected $templating;

    public function __construct($mailer, $to, EngineInterface $templating){
        $this->mailer=$mailer;
        $this->to=$to;
        $this->templating=$templating;
    }
    
    public function sendCreate(){
        $this->template="emails/create.html.twig";
        return $this;
    }
    
    public function sendUpdate(){
        $this->template="emails/update.html.twig";
        return $this;
    }
    
    public function sendDelete(){
        $this->template="emails/delete.html.twig";
        return $this;
    }
    
    public function send($params){
        $message=\Swift_Message::newInstance()
            ->setSubject('Changement sur Wikebec')
            ->setFrom('send@exemple.com')
            ->setTo($this->to)
            ->setBody(
                $this->templating->render(
                    $this->template,
                    $params
                ),
                'text/html'
            );
        
        return $this->mailer->send($message);
    }
}



