<?php

/*  Museum Collection Viewer - Mit License */
namespace ZFTest\User;

use PHPUnit_Framework_TestCase;
use Zend\ServiceManager\ServiceManager;
use ZFT\User\DataMapperInterface;
use ZFT\User\IdentityMapInterface;
use ZFT\User\MemoryIdentityMap;
use ZFT\User\PostgresDataMapper;
use ZFT\User\Repository;
use ZFT\User\RepositoryFactory;

class RepositoryFactoryTest extends PHPUnit_Framework_TestCase{
    function testCanCreateUserRepository(){
        $sm = new ServiceManager();
        $sm->setFactory(MemoryIdentityMap::class, function(){
            return new class() implements IdentityMapInterface{
            };
        });
        $sm->setFactory(PostgresDataMapper::class,function(){
            return new class() implements DataMapperInterface{
            };
        });
        
        $factory = new RepositoryFactory();
        $repository = $factory($sm, RepositoryFactory::class);
        
        $this->assertInstanceOf(Repository::class, $repository);
    }
}