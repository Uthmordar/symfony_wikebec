<?php

namespace AppBundle\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class DefaultController extends Controller
{
    
    /**
     * @Route("/", name="homepage")
     */
    public function indexAction(\Symfony\Component\HttpFoundation\Request $request)
    {
        // NOUVELLE INSTANCE
        $newMot = new \AppBundle\Entity\Mot();
        $newDef = new \AppBundle\Entity\Definition;
        $newExemple = new \AppBundle\Entity\Exemple;
        
        $newMot->getDefinitions()->add($newDef);
        $newMot->getExemples()->add($newExemple);
        
        $motForm = $this->createForm(new \AppBundle\Form\MotType(), $newMot);
        
        $motForm->handleRequest($request);
        
        if($motForm->isValid()){
            $manager = $this->getDoctrine()->getManager();
            
            $manager->persist($newMot);
            $newDef->setMot($newMot);
            $newExemple->setMot($newMot);
            
            $manager->flush();
        }
        
        $motsRepo = $this->getDoctrine()->getRepository("AppBundle:Mot");
        $mots = $motsRepo->findAll();
        
        $params = array(
            "motForm" => $motForm->createView(),
            "mots" => $mots
        );
        
        return $this->render('default/index.html.twig', $params);
    }
}
