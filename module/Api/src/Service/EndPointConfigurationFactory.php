<?php
namespace Api\Service;

use Zend\Config\Config;
use Zend\ServiceManager\FactoryInterface;
use Zend\ServiceManager\ServiceLocatorInterface;

class EndPointConfigurationFactory implements FactoryInterface
{

    /**
     * Create service
     *
     * @param ServiceLocatorInterface $serviceLocator
     *
     * @return EndPointConfiguration
     */
    public function createService(ServiceLocatorInterface $serviceLocator)
    {
        /** @var Config $options */
        $options = $serviceLocator->get('Config');

        return new EndPointConfiguration($options['api_end_point']);
    }}