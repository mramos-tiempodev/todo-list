<?php
namespace Task\Model;

use Zend\Db\ResultSet\ResultSet;
use Zend\Db\Sql\Select;
use Zend\Db\TableGateway\TableGateway;

/**
 * Used to manage data from the database
 */
class Task
{
    /** @var TableGateway */
    private $tableGateway;

    public function __construct(TableGateway $tableGateway)
    {
        $this->setTableGateway($tableGateway);
    }

    /**
     * @return ResultSet
     */
    public function fetchAll()
    {
        return $this->getTableGateway()->select(function (Select $select) {
            $select->order('name ASC');
        });
    }

    /**
     * @param array $data
     *
     * @return bool|int
     */
    public function saveTask($data)
    {
        if (!isset($data['id'])) {
            if (!$this->getTableGateway()->insert($data))
                return false;
            return $this->getTableGateway()->getLastInsertValue();
        } else {
            if (!$this->getTableGateway()->update($data, array('id' => $data['id'])))
                return false;
            return $data['id'];
        }
    }

    /**
     * @return TableGateway
     */
    private function getTableGateway()
    {
        return $this->tableGateway;
    }

    /**
     * @param TableGateway $tableGateway
     */
    private function setTableGateway(TableGateway $tableGateway)
    {
        $this->tableGateway = $tableGateway;
    }
}
