<?php

/*  Museum Collection Viewer - Mit License */

namespace Application\Service\Factory;

use Interop\Container\ContainerInterface;
use Portal\Service\ImageHandler;
use Zend\ServiceManager\Factory\FactoryInterface;

/**
 * Description of ImageHandlerFactory
 *
 * @author hubert
 */
class ImageHandlerFactory implements FactoryInterface {
    //put your code here
    public function __invoke(ContainerInterface $container, $requestedName, mixed $options = null) {
        return new ImageHandler();
    }

}
