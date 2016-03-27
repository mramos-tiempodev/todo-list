<?php
namespace Wall\Controller;

use Api\Client\ApiClient;
use Api\Client\ApiClientFactory;
use User\Entity\User;
use Zend\Hydrator\ClassMethods;
use Zend\ServiceManager\FactoryInterface;
use Zend\ServiceManager\ServiceLocatorInterface;

class IndexControllerFactory implements FactoryInterface
{

    /**
     * Create service
     *
     * @param ServiceLocatorInterface $serviceLocator
     *
     * @return mixed
     */
    public function createService(ServiceLocatorInterface $serviceLocator)
    {
        /** @var User $user */
        $serviceManager = $serviceLocator->getServiceLocator();
        $user = $serviceManager->get('User\Entity\User');
        /** @var ClassMethods $classMethods */
        $classMethods = $serviceManager->get('Zend\Hydrator\ClassMethods');
        /** @var ApiClient $apiClient */
        //$apiClient = $serviceLocator->get('Api\Client\ApiClient');

        $apiClientFactory = new ApiClientFactory();
        $apiClient = $apiClientFactory->createService($serviceLocator);

        return new IndexController($user, $apiClient, $classMethods);
    }
}