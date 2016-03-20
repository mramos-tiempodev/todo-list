<?php
namespace Wall\Controller;

use Api\Client\ApiClient;
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
        //$user = $serviceLocator->get('User\Entity\User');
        $user = new User();
        /** @var ClassMethods $classMethods */
        //$classMethods = $serviceLocator->get('Zend\Hydrator\ClassMethods');
        $classMethods = new ClassMethods();
        /** @var ApiClient $apiClient */
        $apiClient = $serviceLocator->get('Api\Client\ApiClient');

        return new IndexController($user, $apiClient, $classMethods);
    }
}