<?php
namespace UnitTest\Api\Service;

use Api\Service\EndPointConfigurationFactory;
use PHPUnit_Framework_MockObject_MockObject;
use Zend\Config\Config;
use Zend\ServiceManager\ServiceLocatorInterface;

class EndPointConfigurationFactoryTest extends \PHPUnit_Framework_TestCase
{
    /** @var EndPointConfigurationFactory */
    private $sut;

    /** @var ServiceLocatorInterface|PHPUnit_Framework_MockObject_MockObject */
    private $serviceLocator;

    /** @var Config|PHPUnit_Framework_MockObject_MockObject */
    private $config;

    protected function setUp()
    {
        parent::setUp();

        $this->config = $this->getMockBuilder('Zend\Config\Config')->disableOriginalConstructor()->getMock();
        $this->serviceLocator = $this->getMock('Zend\ServiceManager\ServiceLocatorInterface');
        $this->sut = new EndPointConfigurationFactory();
    }

    protected function tearDown()
    {
        parent::tearDown();

        unset($this->sut);
        unset($this->serviceLocator);
        unset($this->config);
    }

    public function testCreateService()
    {
        $this->serviceLocator->expects($this->any())
            ->method('get')
            ->will($this->returnValueMap(array(
                array('Config', $this->config)
            )));

        $actual = $this->sut->createService($this->serviceLocator);

        $this->assertInstanceOf('Api\Service\EndPointConfiguration', $actual);
    }
}
 