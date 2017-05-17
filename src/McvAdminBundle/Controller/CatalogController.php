<?php

namespace McvAdminBundle\Controller;

use McvAdminBundle\Entity\Artifact;
use McvAdminBundle\Service\CollectionFinder;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class CatalogController extends Controller
{
     /**
     * @Route("/catalog")
     */
    public function indexAction()
    {
        $findFiles = new CollectionFinder($this->getParameter('upload_dir'));
        $array = $findFiles->findAll();
        $em = $this->getDoctrine()->getManager();
        $artifact = $em->getRepository('McvAdminBundle:Artifact');
        $artifact->importArtifacts($array,$em);
//        $artifact->isExist($x);
        return $this->render('McvAdminBundle:catalog:list.catalog.html.twig', ['findFiles' => $findFiles]);
    }
}
