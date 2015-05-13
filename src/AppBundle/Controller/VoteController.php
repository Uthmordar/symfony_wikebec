<?php

namespace AppBundle\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use AppBundle\Entity\Vote;
use Symfony\Component\HttpFoundation\Response;


class VoteController extends Controller
{
    /**
     * @Route("/{id}/vote", name="vote")
     */
    public function voteAction($id, Request $request)
    {
        $motsRepo = $this->getDoctrine()->getRepository("AppBundle:Mot");
        $mot = $motsRepo->findOneById($id);
        
        $ip = $request->getClientIp();
        
        $votesRepo = $this->getDoctrine()->getRepository("AppBundle:Vote");
        $vote = $votesRepo->hasAlreadyVoted($mot->getId(), $ip);
        
        if( empty($vote) ){
            $vote = new Vote;
            $vote->setMot($mot);
            $vote->setIp( $request->getClientIp() );
            
            $em = $this->getDoctrine()->getManager();
            $em->persist($vote);
            $em->flush();
            
            $test = ['success'=>true];
            $response = new Response( json_encode($test) );
        } else {
            $response = new Response( json_encode(['success'=>false]) );
        }
        
        return $response;
    }
}
