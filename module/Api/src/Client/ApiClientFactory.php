<?php
namespace Api\Client;

use Api\Service\EndPointConfiguration;
use Api\Service\JsonDecoder;
use Zend\Http\Client;
use Zend\Log\Logger;
use Zend\Log\Writer\Stream;
use Zend\ServiceManager\FactoryInterface;
use Zend\ServiceManager\ServiceLocatorInterface;
use Zend\Session\Container;

class ApiClientFactory implements FactoryInterface
{

    /**
     * Create service
     *
     * @param ServiceLocatorInterface $serviceLocator
     *
     * @return ApiClient
     */
    public function createService(ServiceLocatorInterface $serviceLocator)
    {
        /** @var Client $httpClient */
        $httpClient = $serviceLocator->get('Zend\Http\Client');
        /** @var Container $sessionContainer */
        $sessionContainer = $serviceLocator->get('Zend\Session\Container');
        /** @var Logger $logger */
        $logger = $serviceLocator->get('Zend\Log\Logger');
        /** @var Stream $stream */
        $stream = $serviceLocator->get('Api\Service\Stream');
        /** @var JsonDecoder $decoder */
        $decoder = $serviceLocator->get('Api\Service\JsonDecoder');
        /** @var EndPointConfiguration $endPointConfiguration */
        $endPointConfiguration = $serviceLocator->get('Api\Service\EndPointConfiguration');

        return new ApiClient($httpClient, $sessionContainer, $logger, $stream, $decoder, $endPointConfiguration);
    }
}