<?php
return array(
    'router' => array(
        'routes' => array(
            'task' => array(
                'type' => 'Literal',
                'options' => array(
                    'route'    => '/task',
                    'defaults' => array(
                        'controller' => 'Task\Controller\Taskclient',
                        'action' => 'index'
                    ),
                ),
                'may_terminate' => true,
                'child_routes' => array(
                    'taskclient' => array(
                        'type'    => 'Segment',
                        'options' => array(
                            'route' => '/taskclient[/:action][/:id]',
                            'constraints' => array(
                                'action' => '[a-zA-Z][a-zA-Z0-9_-]*',
                                'id' => '[0-9]+',
                            ),
                            'defaults' => array(
                            ),
                        ),
                    ),
                ),
            ),
            'api' => array(
                'type' => 'Segment',
                'options' => array(
                    'route'    => '/api/task[/id]',
                    'constraints' => array(
                        'id' => '[0-9]+'
                    ),
                    'defaults' => array(
                        'controller' => 'Task\Controller\Taskrest',
                    ),
                ),
            ),
        ),
    ),
    'controllers' => array(
        'factories' => array(
            'Task\Controller\Taskrest' => 'Task\Controller\TaskrestControllerFactory',
        ),
        'invokables' => array(
            //'Task\Controller\Taskrest' => 'Task\Controller\TaskrestController',
            'Task\Controller\Taskclient' => 'Task\Controller\TaskclientController',
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
            'task/taskclient/index'   => __DIR__ . '/../view/task/index/index.phtml',
            'task/taskclient/insert'   => __DIR__ . '/../view/task/index/index.phtml',
            'task/taskclient/create'   => __DIR__ . '/../view/task/index/index.phtml',
            'error/404'               => __DIR__ . '/../view/error/404.phtml',
            'error/index'             => __DIR__ . '/../view/error/index.phtml',
        ),
        'template_path_stack' => array(
            __DIR__ . '/../view',
        )
    ,
        'strategies' => array(
            'ViewJsonStrategy'
        )
    ),
    'service_manager' => array(
        'invokables' => array(
//            'Zend\Hydrator\ClassMethods' => 'Zend\Hydrator\ClassMethods',
//            'Wall\Service\Wizeline' => 'Wall\Service\Wizeline'
        ),
        'factories' => array(
            'Task' => 'Task\Model\TaskFactory'
        ),
    ),
);