<?php
/**
 * @link      http://github.com/zendframework/ZendSkeletonApplication for the canonical source repository
 * @copyright Copyright (c) 2005-2016 Zend Technologies USA Inc. (http://www.zend.com)
 * @license   http://framework.zend.com/license/new-bsd New BSD License
 */

namespace Portal;

use Portal\Controller\AdminController;
use Portal\Controller\IndexController;
use Portal\Controller\ObjectController;
use Zend\Router\Http\Literal;
use Zend\Router\Http\Segment;

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
            'admin' => [
                'type' => Literal::class,
                'options' => [
                    'route'    => '/admin',
                    'defaults' => [
                        'controller' => AdminController::class,
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
            Controller\IndexController::class => Controller\UserRelatedControllerFactory::class,
            Controller\ObjectController::class => Controller\UserRelatedControllerFactory::class,
            Controller\AdminController::class => Controller\UserRelatedControllerFactory::class
        ],
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
];
