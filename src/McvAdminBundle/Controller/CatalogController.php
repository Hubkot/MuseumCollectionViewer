<?php

namespace McvAdminBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;

class CatalogController extends Controller
{
       /**
     * @Route("/admin/catalog")
     */
    public function indexAction()
    {
        return $this->render('McvAdminBundle:layout:admin.list.html.twig');
    }
    
    
}
