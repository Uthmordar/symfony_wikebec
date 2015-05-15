<?php

namespace AppBundle\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;


class DefaultController extends Controller
{
    /**
     * @Route("/", name="homepage")
     */
    public function indexAction()
    {
        $motRepo = $this->getDoctrine()->getRepository("AppBundle:Mot");
        $motDuJourRepo = $this->getDoctrine()->getRepository("AppBundle:MotDuJour");
        $motDuJourId = $motDuJourRepo->findLast()->getMotId();
        $motDuJour = $motRepo->findOneById($motDuJourId);
        
        $params = array(
            "mdj"  => $motDuJour
        );
        
        dump($motDuJour->getDefinitions());
        
        return $this->render('default/index.html.twig', $params);
    }
}
