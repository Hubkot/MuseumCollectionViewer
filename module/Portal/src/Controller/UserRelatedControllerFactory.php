<?php

/*  Museum Collection Viewer - Mit License */

namespace Portal\Controller;

use Interop\Container\ContainerInterface;
use Zend\ServiceManager\Factory\FactoryInterface;
use Zend\ServiceManager\Exception\ContainerException;
use Zend\ServiceManager\Exception\ServiceNotCreatedException;
use Zend\ServiceManager\Exception\ServiceNotFoundException;

use ZFT\User;
class UserRelatedControllerFactory implements FactoryInterface{
    /**
     * 
     * @param ContainerInterface $serviceManager
     * @param string $controllerName
     * @param array|null|null $options
     * @throws ServiceNotFoundException if unable to resolve the service.
     * @throws ServiceNotCreatedException if an exception is raised when
     * @throws ContainerException if any other error occur
     * @return mixed
     */    
    public function __invoke(ContainerInterface $serviceManager, $controllerName, array $options = null) {
        if(!class_exists($controllerName)){
            throw new ServiceNotFoundException("Nie udalo się stworzyć klasy kontrolera: ".$controllerName);
        }
        $repository = $serviceManager->get(User\Repository::class);
        return new $controllerName($repository);
    }
}


