<?php

namespace McvBundle\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class ArtifactController extends Controller{
    
    /**
     * @Route("/artifact", name="index_art_action")
     * @return type
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
                ->getRepository('McvAdminBundle:Artifact')
                ->findLikeInventory('mhmg-b',10);
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
                ->getRepository('McvAdminBundle:Artifact')
                ->findOneBy(['inventoryNumber' => $inventoryNumber]);
        
        $artifactDescription = $this->getDoctrine()
                ->getRepository('McvAdminBundle:ArtifactDescription')
                ->findOneBy(['artifact_id' => $artifact->getId()]);
        return $this->render('McvBundle:mcv:artifact/description.html.twig', ['artifact' => $artifact,'artifact_description' => $artifactDescription]);
    }
    
    /**
     * @Route("/card", name="artifact_card")
     * Generates inventory card of selected artifact
     */
    public function createArtifactCard(){
        $viewArray = [];
        $desc = $this->getDoctrine()
                ->getRepository('McvAdminBundle:Artifact')
                ->findAllDesc();
        
        foreach ($desc as $d){
        var_dump($d);
            array_push($viewArray, $d);
        }
        
        
        return $this->render('McvBundle:mcv:artifact/artifact-card.html.twig', ['viewArray' => $viewArray]);
    }
  
    
    
}
