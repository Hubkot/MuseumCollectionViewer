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
        
        $artifact = $this->getDoctrine()
                ->getRepository('McvBundle:Artifact')
                ->findAll();
        if(!$artifact){
            throw $this->createNotFoundException(
                    'Nie znalazłem żadnego rekordu artifact');
        }
        return $this->render('McvBundle:mcv:artifact/list.html.twig', ['artifact' => $artifact]);
    }
    /**
     * @Route("/artifact/desc/{inventoryNumber}", name="artifact_description")
     * @param string $inventoryNumber
     */
    public function descriptionAction($inventoryNumber){
        
        $artifact = $this->getDoctrine()
                ->getRepository('McvBundle:Artifact')
                ->findOneBy(['inventoryNumber' => $inventoryNumber]);
        print_r($artifact);
        return $this->render('McvBundle:mcv:artifact/description.html.twig', ['artifact' => $artifact]);
    }
    
}
