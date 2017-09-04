<?php

namespace McvBundle\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Session\Session;

class DefaultController extends Controller
{
    /**
     * @Route("/")
     */
    public function indexAction()
    {
           return $this->render('McvBundle:mcv:base.html.twig');
    }
}
