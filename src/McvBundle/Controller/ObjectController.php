<?php

namespace McvBundle\Controller;

use McvBundle\DependencyInjection\ImageHandler;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Response;

class ObjectController extends Controller {
    /**
     * @Route("/mcv")
     */
    public function indexAction(){
        var_dump($this->get('mcv.imagehandler'));
        $object = new ImageHandler;
        echo $object->getNoticed();
        return new Response('<html><body><p>Nowy moduł opisujący zabytki</p></body></html>');
    }
    /**
     * 
     * @Route("/mcv/object")
     */
    public function objectAction(){
        var_dump($this->get('mcv.imagehandler'));
        $object = new ImageHandler;
        echo $object->getNoticed();
        return new Response('<html><body><p>Nowy moduł opisujący zabytki</p></body></html>');
    }
}
