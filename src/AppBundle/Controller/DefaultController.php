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
        $motsRepo = $this->getDoctrine()->getRepository("AppBundle:Mot");
        $mots = $motsRepo->findAll();
        
        $params = array(
            "mots" => $mots
        );
        
        return $this->render('default/index.html.twig', $params);
    }
}
