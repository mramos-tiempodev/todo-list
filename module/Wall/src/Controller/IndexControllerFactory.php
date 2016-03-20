<?php
namespace Wall\Controller;

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
        $user = $serviceLocator->get('User\Entity\User');
        /** @var ClassMethods $classMethods */
        $classMethods = $serviceLocator->get('Zend\Hydrator\ClassMethods');
        /** @var ApiClient $apiClient */
        $apiClient = $serviceLocator->get('');

        return new IndexController($user, $apiClient, $classMethods);
    }
}