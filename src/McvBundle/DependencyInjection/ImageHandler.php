<?php
namespace McvBundle\DependencyInjection;

class ImageHandler{
    private $transport = ['prepare_this_file.jpg'];
    
    public function getNoticed(){
        return 'I am alive!';
    }
}
