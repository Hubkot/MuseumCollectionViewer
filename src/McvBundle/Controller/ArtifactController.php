<?php

namespace McvBundle\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Response;
class ArtifactController extends Controller{
    /**
     * 
     * @Route("/", name="artifact_index")
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
                ->getRepository('McvAdminBundle:Artifact')
                ->findOneBy(['inventoryNumber' => $inventoryNumber]);
        
        $artifactDescription = $this->getDoctrine()
                ->getRepository('McvAdminBundle:ArtifactDescription')
                ->findOneBy(['artifact_id' => $artifact->getId()]);
        return $this->render('McvBundle:mcv:artifact/description.html.twig', ['artifact' => $artifact,'artifact_description' => $artifactDescription]);
    }
  
    
    
}
