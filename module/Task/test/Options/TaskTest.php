<?php
namespace UnitTest\Task\Option;

use Task\Options\Task as TaskOptions;

class TaskTest extends \PHPUnit_Framework_TestCase
{
    /** @var TaskOptions */
    private $sut;

    protected function setUp()
    {
        $this->sut = new TaskOptions();
    }

    protected function tearDown()
    {
        unset($this->sut);
    }

    public function testExchangeArrayNoDataForId()
    {
        $data = array();
        $this->sut->exchangeArray($data);
        $this->assertNull($this->sut->id);
    }

    public function testExchangeArrayNoDataForName()
    {
        $data = array();
        $this->sut->exchangeArray($data);
        $this->assertNull($this->sut->name);
    }

    public function testExchangeArrayNoDataForStatus()
    {
        $data = array();
        $this->sut->exchangeArray($data);
        $this->assertNull($this->sut->status);
    }

    public function testExchangeArrayWithDataForId()
    {
        $data = array('id' => 1);
        $this->sut->exchangeArray($data);
        $this->assertEquals($this->sut->id, $data['id']);
    }

    public function testExchangeArrayWithDataForName()
    {
        $data = array('name' => 'pepe');
        $this->sut->exchangeArray($data);
        $this->assertEquals($this->sut->name, $data['name']);
    }

    public function testExchangeArrayWithDataForStatus()
    {
        $data = array('status' => 1);
        $this->sut->exchangeArray($data);
        $this->assertEquals($this->sut->status, $data['status']);
    }

    public function testGetArrayCopy()
    {
        $actual = $this->sut->getArrayCopy();
        $this->assertArrayHasKey('id', $actual);
        $this->assertArrayHasKey('name', $actual);
        $this->assertArrayHasKey('status', $actual);
    }
}
 