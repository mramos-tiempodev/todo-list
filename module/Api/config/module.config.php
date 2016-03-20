<?php
return array(
    'service_manager' => array(
        'factories' => array(
            'Api\Service\Stream' => 'Api\Service\StreamFactory',
            'Api\Service\EndPointConfiguration' => 'Api\Service\EndPointConfigurationFactory',
            'Api\Client\ApiClient' => 'Api\Client\ApiClientFactory',
        ),
        'invokables' => array(
            'Api\Service\JsonDecoder' => 'Api\Service\JsonDecoder',
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