<?php

namespace McvAdminBundle\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\Filesystem\Filesystem;

class HelpersController extends Controller
{
      /**
     * @Route("/create-files/{prefix}/{fotonumber}/{category}", name="create_custom_files")"
     * @param type $prefix
     */
    public function createFiles($prefix,int $fotonumber = 1,$category = 'P'){
        $filename = '';
        $extension = '.jpg';
        
        $filesystem = new Filesystem();
        for($i = 0;$i < 12; $i++){
            $filename = $prefix.'_'.$fotonumber.'_'.$category.$extension;
            $filesystem->touch('custom_catalog/'.$filename);
            $fotonumber++;
        }
        
        
        return $this->render('McvAdminBundle:catalog:imported.files.html.twig');
        
    }
}
