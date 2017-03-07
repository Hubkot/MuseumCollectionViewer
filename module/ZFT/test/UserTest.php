<?php

/**
 * Description of UserTest
 *
 * @author hubert
 */
namespace ZFTest;
use PHPUnit_Framework_TestCase;
use ZFT\User;
class UserTest extends PHPUnit_Framework_TestCase{
    public function testCanCreateUserObject(){
        $user = new User();
        
        $this->assertInstanceOf(User::class, $user);
    }
}
