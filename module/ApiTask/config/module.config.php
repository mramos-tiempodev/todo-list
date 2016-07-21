<?php
return array(
    'router' => array(
        'routes' => array(
            'api' => array(
                'type' => 'Segment',
                'options' => array(
                    'route'    => '/api/task[/id]',
                    'constraints' => array(
                        'id' => '[0-9]+'
                    ),
                    'defaults' => array(
                        'controller' => 'ApiTask\Controller\Taskrest',
                    ),
                ),
            ),
        ),
    ),
    'controllers' => array(
        'factories' => array(
            'ApiTask\Controller\Taskrest' => 'ApiTask\Controller\TaskrestControllerFactory',
        ),
    ),
);