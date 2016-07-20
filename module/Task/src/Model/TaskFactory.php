<?php
namespace Task\Model;

use Zend\Db\Adapter\AdapterInterface;
use Zend\Hydrator\ObjectProperty;
use Zend\Db\TableGateway\TableGateway;
use Zend\Db\ResultSet\HydratingResultSet;
use Task\Model\Task as TaskModel;
use Task\Options\Task as TaskOption;
use Zend\ServiceManager\FactoryInterface;
use Zend\ServiceManager\ServiceLocatorInterface;


class TaskFactory implements FactoryInterface
{

    const TABLE = 'tasks';

    const DB_ADAPTER = 'Zend\Db\Adapter\Adapter';

    /**
     * Create service
     *
     * @param ServiceLocatorInterface $serviceLocator
     *
     * @return TaskModel
     */
    public function createService(ServiceLocatorInterface $serviceLocator)
    {
        /** @var AdapterInterface $db */
        $db = $serviceLocator->get(self::DB_ADAPTER);
        $resultSetProperty = new HydratingResultSet();
        $resultSetProperty->setHydrator(new ObjectProperty());
        $resultSetProperty->setObjectPrototype(new TaskOption());

        $tableGateway = new TableGateway(self::TABLE, $db, null, $resultSetProperty);
        return new TaskModel($tableGateway);
    }
}
