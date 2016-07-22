<?php
namespace UnitTest\Task\Model;

use PHPUnit_Framework_MockObject_MockObject;
use Task\Model\TaskFactory;
use Zend\Db\Adapter\AdapterInterface;
use Zend\ServiceManager\ServiceLocatorInterface;

class TaskFactoryTest extends \PHPUnit_Framework_TestCase
{
    /** @var TaskFactory */
    private $sut;

    /** @var ServiceLocatorInterface|PHPUnit_Framework_MockObject_MockObject */
    private $serviceLocator;

    /** @var AdapterInterface */
    private $adapter;

    protected function setUp()
    {
        $this->serviceLocator = $this->getMock('Zend\ServiceManager\ServiceLocatorInterface');
        $this->adapter = $this->getMock('Zend\Db\Adapter\AdapterInterface');
        $this->sut = new TaskFactory();
    }

    protected function tearDown()
    {
        unset(
            $this->sut,
            $this->serviceLocator,
            $this->adapter
        );
    }

    public function testCreateService()
    {
        $this->serviceLocator->expects($this->any())
            ->method('get')
            ->will($this->returnValueMap(array(
                    array('Zend\Db\Adapter\Adapter', $this->adapter)
                )
            ));
        $actual = $this->sut->createService($this->serviceLocator);

        $this->assertInstanceOf('Task\Model\Task', $actual);
    }
}
 