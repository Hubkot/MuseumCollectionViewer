<?php

namespace McvAdminBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;

class DefaultController extends Controller
{
    /**
     * @Route("/", name="index_action")
     */
    public function indexAction()
    {
        return $this->render('McvAdminBundle:layout:admin.list.html.twig');
    }
}
