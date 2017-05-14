<?php

namespace McvAdminBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;

class DefaultController extends Controller
{
    /**
     * @Route("/")
     */
    public function indexAction()
    {
        echo 'Default Controller McvAdminBundle indexAction()';
        return $this->render('McvAdminBundle:layout:admin.list.html.twig');
    }
}
