<?php
namespace Api\Service;

use Zend\Config\Config;
use Zend\Log\Writer\Stream;
use Zend\ServiceManager\FactoryInterface;
use Zend\ServiceManager\ServiceLocatorInterface;

class StreamFactory implements FactoryInterface
{
    /**
     * Create service
     *
     * @param ServiceLocatorInterface $serviceLocator
     *
     * @return Stream
     */
    public function createService(ServiceLocatorInterface $serviceLocator)
    {
        /** @var Config $options */
        $options = $serviceLocator->get('Config');
        $pathLog = $options['api']['client_log'];
        return new Stream($pathLog);
    }
}