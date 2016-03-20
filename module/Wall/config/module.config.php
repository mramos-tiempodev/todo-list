<?php
return array(
    'router' => array(
        'routes' => array(
            'wall' => array(
                'type' => 'Zend\Mvc\Router\Http\Segment',
                'options' => array(
                    'route'    => '/:username',
                    'constraints' => array(
                        'username' => '\w+'
                    ),
                    'defaults' => array(
                        'controller' => 'Wall\Controller\Index',
                        'action'     => 'index',
                    ),
                ),
            )
        ),
    ),
    'controllers' => array(
        'factories' => array(
            'Wall\Controller\Index' => 'Wall\Controller\IndexControllerFactory',
        ),
    ),
    'view_manager' => array(
        'display_not_found_reason' => true,
        'display_exceptions'       => true,
        'doctype'                  => 'HTML5',
        'not_found_template'       => 'error/404',
        'exception_template'       => 'error/index',
        'template_map' => array(
            'layout/layout'           => __DIR__ . '/../view/layout/layout.phtml',
//            'application/index/index' => __DIR__ . '/../view/application/index/index.phtml',
            'error/404'               => __DIR__ . '/../view/error/404.phtml',
            'error/index'             => __DIR__ . '/../view/error/index.phtml',
        ),
        'template_path_stack' => array(
            __DIR__ . '/../view',
        ),
    ),
    'service_manager' => array(
        'invokables' => array(
            'Zend\Hydrator\ClassMethods' => 'Zend\Hydrator\ClassMethods',
        ),
    ),
);