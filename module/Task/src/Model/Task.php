<?php
namespace Task\Model;

use Zend\Db\Sql\Select;
use Zend\Db\TableGateway\TableGateway;

/**
 * Used to fetch data from the database
 */
class Task
{
    /** @var TableGateway */
    private $tableGateway;

    public function __construct(TableGateway $tableGateway)
    {
        $this->setTableGateway($tableGateway);
    }

    public function fetchAll()
    {
        return $this->getTableGateway()->select(function (Select $select) {
            $select->order('name ASC');
        });
    }

    public function saveTask($data)
    {
        if (!isset($data['id'])) {
            if (!$this->getTableGateway()->insert($data))
                return false;
            return $this->getTableGateway()->getLastInsertValue();
        }
        elseif ($data['id']) {
            if (!$this->getTableGateway()->update($data, array('id' => $data['id'])))
                return false;
            return $data['id'];
        }
        else
            return false;
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
