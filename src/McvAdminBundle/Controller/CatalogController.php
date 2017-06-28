<?php

namespace McvAdminBundle\Controller;

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
        return $this->render('McvAdminBundle:layout:admin.list.html.twig');
    }
     /**
     * @Route("/collection-finder", name="collection-finder")
     */
    public function finderAction()
    {
        $findFiles = new CollectionFinder($this->getParameter('upload_dir'));
        $findFiles->findAll();
     
        return $this->render('McvAdminBundle:catalog:list.catalog.html.twig', ['findFiles' => $findFiles]);
    }
}
