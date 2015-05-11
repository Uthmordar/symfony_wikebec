<?php

namespace AppBundle\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

class MotController extends Controller
{
    /**
     * @Route("/create", name="createMot")
     */
    public function createAction(Request $request)
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
        
        $params = array(
            "motForm" => $motForm->createView()
        );
        
        return $this->render('default/create.html.twig', $params);
    }
    
    /**
     * @Route("/edit/{id}", name="editMot")
     */
    public function editAction($id, Request $request)
    {
        $motsRepo = $this->getDoctrine()->getRepository("AppBundle:Mot");
        $mot = $motsRepo->findOneById($id);
        
        $defs = $mot->getDefinitions();
        $exemples = $mot->getExemples();
        
        $originalDefs = new \Doctrine\Common\Collections\ArrayCollection();
        $originalExemples = new \Doctrine\Common\Collections\ArrayCollection();
        
        foreach ($defs as $def) {
            $originalDefs->add($def);
        }
        foreach ($exemples as $exemple) {
            $originalExemples->add($exemple);
        }
        
        $motForm = $this->createForm(new \AppBundle\Form\MotType(), $mot);
        
        $motForm->handleRequest($request);
        
        if($motForm->isValid()){
            $manager = $this->getDoctrine()->getManager();
            
            
            
            foreach ($originalDefs as $def) {
                $manager->persist($def);
            }
            
            foreach ($originalExemples as $exemple) {
                if ($mot->getExemples()->contains($exemple) == false) {
                    $manager->remove($exemple);
                } else {
                    $manager->persist($exemple);    
                }
            }
            
            setcookie('wikebek_user_email', $mot->getEmail(), time()+2500000);
            
            $manager->persist($mot);
            
            $manager->flush();
        }
        
        $mots = $motsRepo->findAll();
        
        $params = array(
            "motForm" => $motForm->createView(),
            "mots" => $mots
        );
        
        return $this->render('default/edit.html.twig', $params);
    }
}
