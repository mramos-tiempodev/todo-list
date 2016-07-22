<?php
namespace UnitTest\Task\Model;

use PHPUnit_Framework_MockObject_MockObject;
use Task\Model\Task as TaskModel;
use Zend\Db\ResultSet\ResultSet;
use Zend\Db\TableGateway\TableGateway;

class TaskTest extends \PHPUnit_Framework_TestCase
{
    /** @var TaskModel */
    private $sut;

    /** @var TableGateway|PHPUnit_Framework_MockObject_MockObject */
    private $tableGateway;

    /** @var ResultSet|PHPUnit_Framework_MockObject_MockObject */
    private $resultSet;

    protected function setUp()
    {
        $this->resultSet = $this->getMockBuilder('Zend\Db\ResultSet\ResultSet')
            ->disableOriginalConstructor()
            ->getMock();
        $this->tableGateway = $this->getMockBuilder('Zend\Db\TableGateway\TableGateway')
            ->disableOriginalConstructor()
            ->getMock();
        $this->sut = new TaskModel($this->tableGateway);
    }

    protected function tearDown()
    {
        unset($this->sut, $this->tableGateway);
    }

    public function testFetchAll()
    {
        $this->tableGateway->expects($this->any())
            ->method('select')
            ->will($this->returnValue($this->resultSet));

        $actual = $this->sut->fetchAll();

        $this->assertInstanceOf('Zend\Db\ResultSet\ResultSet', $actual);
    }

    public function testSaveTaskNoIdAndNoInsert()
    {
        $this->tableGateway->expects($this->any())
            ->method('insert')
            ->will($this->returnValue(false));
        $actual = $this->sut->saveTask(array());

        $this->assertFalse($actual);
    }

    public function testSaveTaskNoIdAndInsert()
    {
        $lastInsertValue = 1;
        $this->tableGateway->expects($this->any())
            ->method('getLastInsertValue')
            ->will($this->returnValue($lastInsertValue));
        $this->tableGateway->expects($this->any())
            ->method('insert')
            ->will($this->returnValue(true));
        $actual = $this->sut->saveTask(array());

        $this->assertEquals($actual, $lastInsertValue);
    }

    public function testSaveTaskIdAndNoUpdate()
    {
        $data = array('id' => 1);
        $this->tableGateway->expects($this->any())
            ->method('update')
            ->will($this->returnValue(false));
        $actual = $this->sut->saveTask($data);

        $this->assertFalse($actual);
    }

    public function testSaveTaskIdAndUpdate()
    {
        $data = array('id' => 1);
        $this->tableGateway->expects($this->any())
            ->method('update')
            ->will($this->returnValue(true));
        $actual = $this->sut->saveTask($data);

        $this->assertEquals($actual, $data['id']);
    }
}
 