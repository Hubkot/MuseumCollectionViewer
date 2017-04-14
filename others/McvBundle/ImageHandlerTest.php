<?php

namespace Tests\McvBundle\DependencyInjection\ImageHandler;

use McvBundle\DependencyInjection\ImageHandler;


class ImageHandlerTest 
{
    public function testCanCreateImageHandlerObject()
    {
        $object = new ImageHandler();
        $this->assertInstanceOf(ImageHandler::class, $object);
    }
}
//
//class UserTest extends PHPUnit_Framework_TestCase{
//    public function testCanCreateUserObject(){
//        $user = new User();
//        
//        $this->assertInstanceOf(User::class, $user);
//    }
//}
