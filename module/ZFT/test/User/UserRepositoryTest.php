<?php

/*  Mit License

  /**
 * Description of UserRepositoryTest
 *
 * @author hubert
 */
namespace ZFTest\User;

use PHPUnit_Framework_TestCase;
use ZFT\User\Repository as UserRepository;
use ZFT\User;
class UserRepositoryTest extends PHPUnit_Framework_TestCase {
    public function testCanCreateUserRepositoryObject(){
        
        $identityMapStub = new class() implements User\IdentityMapInterface{};
        $dataMapperStub = new class() implements User\DataMapperInterface{};
        
        
        $repository = new UserRepository($identityMapStub, $dataMapperStub);
        
        $this->assertInstanceOf(UserRepository::class, $repository);
    }
}
