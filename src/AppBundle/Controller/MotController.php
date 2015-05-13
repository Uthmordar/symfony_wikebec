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
        $captcha=$this->get('recaptcha_services');
        // NOUVELLE INSTANCE
        $newMot = new \AppBundle\Entity\Mot();
        $newDef = new \AppBundle\Entity\Definition;
        $newExemple = new \AppBundle\Entity\Exemple;
        
        $newMot->getDefinitions()->add($newDef);
        $newMot->getExemples()->add($newExemple);
        
        $motForm = $this->createForm(new \AppBundle\Form\MotType(), $newMot);
        
        $motForm->handleRequest($request);
        
        if($motForm->isValid()){
            $response= $captcha->setToken($request->get('g-recaptcha-response'))->checkResponse();
            if(json_decode($response)->success){
                $manager = $this->getDoctrine()->getManager();
            
                $manager->persist($newMot);
                $newDef->setMot($newMot);
                $newExemple->setMot($newMot);
                setcookie('wikebek_user_email', $mot->getEmail(), time()+2500000);
                $infoText = $newMot->getTerme() . ' a bien été créé!';
                $this->addFlash('info', $infoText);
                
                $manager->flush();
                return $this->redirectToRoute('showDefinitionMot', ['id'=>$newMot->getId()]);
            }else{
                $this->addFlash('error', 'Veuillez valider le captcha');
            }            
        }
        
        $params = array(
            "motForm" => $motForm->createView()
        );
        
        return $this->render('default/mot/create.html.twig', $params);
    }
    
    /**
     * @Route("/{id}/definition", name="showDefinitionMot")
     */
    public function showDefinitionAction($id, Request $request)
    {
        $motsRepo = $this->getDoctrine()->getRepository("AppBundle:Mot");
        $mot = $motsRepo->findOneById($id);
        
        $ip = $request->getClientIp();
        
        $votesRepo = $this->getDoctrine()->getRepository("AppBundle:Vote");
        $query=$votesRepo->hasAlreadyVoted($mot->getId(), $ip);
        $hasVoted = (empty($query))? false : true;
        
        $confirmForm = $this->createForm(new \AppBundle\Form\ConfirmType());
        $confirmForm->handleRequest($request);
        
        if($confirmForm->isValid()){
            $captcha=$this->get('recaptcha_services');
            setcookie('wikebek_user_email', $_POST['appbundle_confirm']['email'], time()+2500000);
            $response=$captcha->setToken($request->get('g-recaptcha-response'))->checkResponse();
            
            if(json_decode($response)->success){
                return $this->redirectToRoute('deleteMot', ['id'=>$id]);
            }else{
                $this->addFlash('error', 'Veuillez valider le captcha');
            }            
        }
        
        $params = [
            'mot'=> $mot,
            'confirmForm' => $confirmForm->createView(),
            'hasVoted' => $hasVoted
        ];
        
        return $this->render('default/mot/definition.html.twig', $params);
    }
    
    
    /**
     * @Route("{id}/edit", name="editMot")
     */
    public function editAction($id, Request $request)
    {
        $captcha=$this->get('recaptcha_services');
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
            $response=$captcha->setToken($request->get('g-recaptcha-response'))->checkResponse();
            if(json_decode($response)->success){
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
                
                $infoText = $mot->getTerme() . ' a bien été modifié!';
                $this->addFlash('info', $infoText);
                return $this->redirectToRoute('showDefinitionMot', ['id'=>$id]);
            }else{
                $this->addFlash('error', 'Veuillez valider le captcha');
            }
        }
        
        $mots = $motsRepo->findAll();
        
        $params = array(
            "motForm" => $motForm->createView(),
            "mots" => $mots
        );
        
        return $this->render('default/mot/edit.html.twig', $params);
    }
    
    /**
     * @Route("{id}/delete", name="deleteMot")
     */
    public function deleteAction($id, Request $request)
    {
        if( !isset($_COOKIE['wikebek_user_email']) ){
            $this->addFlash('error', 'Mail non-renseigné.');
            return $this->redirectToRoute('homepage');
        }
        
        $motsRepo = $this->getDoctrine()->getRepository("AppBundle:Mot");
        $mot = $motsRepo->findOneById($id);
        $mot->setEmail(filter_input( INPUT_COOKIE, 'wikebek_user_email' ));
        $em = $this->getDoctrine()->getManager();
        $em->remove($mot);
        $em->flush();
        
        $infoText = $mot->getTerme() . ' a bien été supprimmé!';
        $this->addFlash('info', $infoText);
        return $this->redirectToRoute('homepage');
    }
    
    public function getCaptchaAction(){
        $captcha=$this->get('recaptcha_services');
        
        $params=[
            'secret_key'=>$captcha->getSecret()
        ];
        
        return $this->render('includes/captcha.html.twig', $params);
    }
}
