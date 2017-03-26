<?php
/**
 * @link      http://github.com/zendframework/ZendSkeletonApplication for the canonical source repository
 * @copyright Copyright (c) 2005-2016 Zend Technologies USA Inc. (http://www.zend.com)
 * @license   http://framework.zend.com/license/new-bsd New BSD License
 */

namespace Portal;

use Application\Service\Factory\ImageHandlerFactory;
use Doctrine\ORM\Mapping\Driver\AnnotationDriver;
use Portal\Controller\IndexController;
use Portal\Controller\ObjectController;
use Portal\Service\ImageHandler;
use Zend\Router\Http\Literal;
use Zend\Router\Http\Segment;
use Zend\ServiceManager\Factory\InvokableFactory;

return [
    'router' => [
        'routes' => [
            'home' => [
                'type' => Literal::class,
                'options' => [
                    'route'    => '/',
                    'defaults' => [
                        'controller' => IndexController::class,
                        'action'     => 'index',
                    ],
                ],
            ],
            'object' => [
                'type' => Literal::class,
                'options' => [
                    'route'    => '/object',
                    'defaults' => [
                        'controller' => ObjectController::class,
                        'action'     => 'index',
                    ],
                ],
            ],
            'portal' => [
                'type'    => Segment::class,
                'options' => [
                    'route'    => '/portal[/:action]',
                    'defaults' => [
                        'controller' => IndexController::class,
                        'action'     => 'index',
                    ],
                ],
            ],
        ],
    ],
    'controllers' => [
        'factories' => [
            Controller\IndexController::class => InvokableFactory::class,
            Controller\ObjectController::class => InvokableFactory::class,
        ],
    ],
    'service_manager' => [
        ImageHandler::class => ImageHandlerFactory::class,
    ],
    'view_manager' => [
        'display_not_found_reason' => true,
        'display_exceptions'       => true,
        'doctype'                  => 'HTML5',
        'not_found_template'       => 'error/404',
        'exception_template'       => 'error/index',
        'template_map' => [
            'layout/layout'           => __DIR__ . '/../view/layout/layout.phtml',
            'portal/index/index' => __DIR__ . '/../view/portal/index/index.phtml',
            'error/404'               => __DIR__ . '/../view/error/404.phtml',
            'error/index'             => __DIR__ . '/../view/error/index.phtml',
        ],
        'template_path_stack' => [
            __DIR__ . '/../view',
        ],
    ],
    'doctrine' => [
        'driver' => [
            __NAMESPACE__. '_driver' => [
                'class' => AnnotationDriver::class,
                'cache' => 'array',
                'paths' => [__DIR__.'/../src/Entity']
            ],
            'orm_default' => [
                'drivers' => [
                    __NAMESPACE__ .'\Entity' => __NAMESPACE__ .'_driver'
                ]
            ]
        ]
    ]
];
