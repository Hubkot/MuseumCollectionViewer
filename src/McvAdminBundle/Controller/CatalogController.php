<?php

namespace McvAdminBundle\Controller;

use McvAdminBundle\Service\CollectionFinder;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class CatalogController extends Controller
{
     /**
     * @Route("/control/catalog")
     */
    public function indexAction()
    {
        $findFiles = new CollectionFinder($this->getParameter('upload_dir'));
        $findFiles->findAll();
        echo '<pre>', print_r($findFiles),'</pre>';
        return $this->render('McvAdminBundle:layout:admin.list.html.twig');
    }
    
    
}
