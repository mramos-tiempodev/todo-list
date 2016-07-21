<?php
namespace ApiTask\Controller;

use Task\Model\Task as TaskModel;
use Zend\ServiceManager\FactoryInterface;
use Zend\ServiceManager\ServiceLocatorInterface;

/**
 * Used to create the TestrestController object and inject all the dependencies
 * required by the object
 */
class TaskRestControllerFactory implements FactoryInterface
{

    /**
     * Create service
     *
     * @param ServiceLocatorInterface $serviceLocator
     *
     * @return TaskrestController
     */
    public function createService(ServiceLocatorInterface $serviceLocator)
    {
        /** @var ServiceLocatorInterface $sm */
        $sm = $serviceLocator->getServiceLocator();
        /** @var TaskModel $taskModel */
        $taskModel = $sm->get('Task');
        return new TaskrestController($taskModel);
    }
}