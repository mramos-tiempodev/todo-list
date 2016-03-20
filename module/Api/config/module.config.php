<?php
return array(
    'service_manager' => array(
        'factories' => array(
        ),
        'invokables' => array(
        ),
    ),
    'api' => array(
        'end_point' => array(
            'host' => 'http://api.elartedelpapaloteo.com',
            'wall' => '/api/wall/%s',
        ),
        'client_log' => 'data/logs/apiclient.log'
    ),
);