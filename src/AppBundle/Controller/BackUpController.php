<?php

namespace AppBundle\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use AppBundle\Entity\Definition;
use AppBundle\Entity\Exemple;

class BackUpController extends Controller
{
    /**
     * @Route("/backup", name="backupList")
     */
    public function indexAction()
    {  
        $backupRepo = $this->getDoctrine()->getRepository("AppBundle:BackUp");
        $backups = $backupRepo->findAll();
        $result= [];
        
        $backupExempleRepo = $this->getDoctrine()->getRepository("AppBundle:ExempleBackUp");
        $exemples = $backupExempleRepo->findAll();
        $resultEx= [];
        
        $backupDefinitionRepo = $this->getDoctrine()->getRepository("AppBundle:DefinitionBackUp");
        $definitions = $backupDefinitionRepo->findAll();
        $resultDef= [];
        
        foreach($backups as $backup){
            $result[$backup->getMotId()]=unserialize($backup->getData());
        }
        
        foreach($exemples as $backup){
            $resultEx[$backup->getMotId()]=unserialize($backup->getData());
        }
        
        foreach($definitions as $backup){
            $resultDef[$backup->getMotId()]=unserialize($backup->getData());
        }
               
        $params=array(
            "backups" => $result,
            "exemples" => $resultEx,
            "definitions" => $resultDef
        );
        
        return $this->render('backup/index.html.twig', $params);
    }
    
    /**
     * @Route("/backup/{id}", name="showBackUpMot")
     */
    public function showAction($id){
        $motsRepo = $this->getDoctrine()->getRepository("AppBundle:Mot");
        $mot = $motsRepo->findOneById($id);
        
        $backUpRepo=$this->getDoctrine()->getRepository("AppBundle:BackUp");
        $mots=$backUpRepo->findMotByMotId($id);
        $result=[];
        
        $backExempleUpRepo=$this->getDoctrine()->getRepository("AppBundle:ExempleBackUp");
        $bEx=$backExempleUpRepo->findExempleByMotId($id);
        $resultEx=[];
        
        $backDefinitionUpRepo=$this->getDoctrine()->getRepository("AppBundle:DefinitionBackUp");
        $bDef=$backDefinitionUpRepo->findDefinitionByMotId($id);
        $resultDef=[];
        
        foreach($mots as $m){
            $result[$m->getId()]=unserialize($m->getData());
        }
        
        foreach($bEx as $m){
            $resultEx[$m->getId()]=['data'=>unserialize($m->getData()), 'status'=>$m->getModType()];
        }
        
        foreach($bDef as $m){
            $resultDef[$m->getId()]=['data'=> unserialize($m->getData()), 'status'=>$m->getModType()];
        }
         
        $params=[
            "mot"=>$mot,
            "backups"=>$result,
            "bEx" => $resultEx,
            "bDef" => $resultDef
        ];

        return $this->render('backup/show.html.twig', $params);
    }
    
    /**
     * @Route("/backup/restaure/mot/{id}", name="restaureBackUpMot")
     */
    public function restaureTerme($id){
        $manager = $this->getDoctrine()->getManager();
        
        $backUpRepo=$this->getDoctrine()->getRepository("AppBundle:BackUp");
        $backup=$backUpRepo->findOneById($id);

        $mot=unserialize($backup->getData());
        
        $motsRepo = $this->getDoctrine()->getRepository("AppBundle:Mot");
        $motOld = $motsRepo->findOneById($mot->getId());
        
        $motOld->setTerme($mot->getTerme())
                ->setVariations($mot->getVariations())
                ->setPrononciation($mot->getPrononciation())
                ->setNature($mot->getNature())
                ->setGenre($mot->getGenre())
                ->setNombre($mot->getNombre())
                ->setOrigine($mot->getOrigine())
                ->setEmail($this->container->getParameter('admin_mail'));
        
        $manager->remove($backup);
        $manager->flush();
        
        $referer = $this->getRequest()->headers->get('referer');

        return $this->redirect($referer);
    }
    
    /**
     * @Route("/backup/restaure/exemple/{id}", name="restaureBackUpExemple")
     */
    public function restaureExemple($id){
        $manager = $this->getDoctrine()->getManager();
        
        $backUpRepo=$this->getDoctrine()->getRepository("AppBundle:ExempleBackUp");
        $backup=$backUpRepo->findOneById($id);

        $exemple=unserialize($backup->getData());
        
        $exRepo = $this->getDoctrine()->getRepository("AppBundle:Exemple");
        $exOld = $exRepo->findOneById($exemple->getId());
        
        if($exOld){
            $exOld->getMot()->setEmail($this->container->getParameter('admin_mail'));

            $exOld->setTexteCa($exemple->getTexteCa())
                    ->setTexteFr($exemple->getTexteFr());
        }else{
            $motsRepo = $this->getDoctrine()->getRepository("AppBundle:Mot");
            $motOld = $motsRepo->findOneById($exemple->getMot()->getId());
            $motOld->setEmail($this->container->getParameter('admin_mail'));
            
            $ex=new Definition();
            $ex->setTexteCa($exemple->getTexteCa())
                    ->setTexteFr($exemple->getTexteFr())
                    ->setMot($motOld);
            
            $manager->persist($ex);
        }
        
        $manager->remove($backup);
        $manager->flush();
        
        $referer = $this->getRequest()->headers->get('referer');

        return $this->redirect($referer);
    }
    
    /**
     * @Route("/backup/restaure/definition/{id}", name="restaureBackUpDefinition")
     */
    public function restaureDefinition($id){
        $manager = $this->getDoctrine()->getManager();
        
        $backUpRepo=$this->getDoctrine()->getRepository("AppBundle:DefinitionBackUp");
        $backup=$backUpRepo->findOneById($id);

        $definition=unserialize($backup->getData());
        
        $defRepo = $this->getDoctrine()->getRepository("AppBundle:Definition");
        $defOld = $defRepo->findOneById($definition->getId());
        
        if($defOld){
            $defOld->getMot()->setEmail($this->container->getParameter('admin_mail'));
            $defOld->setTexte($definition->getTexte());
        }else{
            $motsRepo = $this->getDoctrine()->getRepository("AppBundle:Mot");
            $motOld = $motsRepo->findOneById($definition->getMot()->getId());
            
            $motOld->setEmail($this->container->getParameter('admin_mail'));
            
            $def=new Definition();
            $def->setTexte($definition->getTexte())
                    ->setMot($motOld);
            
            $manager->persist($def);
        }
        $manager->remove($backup);
        $manager->flush();

        $referer = $this->getRequest()->headers->get('referer');

        return $this->redirect($referer);
    }
}
