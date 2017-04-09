<?php

namespace Test\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Response;

class DefaultController extends Controller
{
    /**
     * @Route("/test")
     */
    public function indexAction()
    {
        return new Response('<html><body><p>Hellow</p></body></html>');
    }
}
