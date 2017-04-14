<?php

namespace McvBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;

class ArtifactController extends Controller{
    /**
     * 
     * @Route("/artifact", name="artifact_index")
     */
    public function indexAction(){
        
        return $this->render('McvBundle:mcv:artifact/basic.html.twig');
    }
    /**
     * 
     * @Route("/artifact/list", name="artifact_list")
     */
    public function showListAction(){
        #$em = $this->getDoctrine()->getManager();
        #$artifact =$this->getDoctrine()->getRepository('McvBundle:Artifact');
        #$artifact->findAll();
        #echo '<pre>', print_r($artifact),'</pre>';
        return $this->render('McvBundle:mcv:artifact/basic.html.twig');
    }
}
