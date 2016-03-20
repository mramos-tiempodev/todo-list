<?php
namespace UnitTest\Api\Service;

use Api\Service\StreamFactory;
use PHPUnit_Framework_MockObject_MockObject;
use Zend\Config\Config;
use Zend\ServiceManager\ServiceLocatorInterface;

class StreamFactoryTest extends \PHPUnit_Framework_TestCase
{
    /** @var StreamFactory */
    private $sut;

    /** @var ServiceLocatorInterface|PHPUnit_Framework_MockObject_MockObject */
    private $serviceLocator;

    protected function setUp()
    {
        parent::setUp();

        $this->serviceLocator = $this->getMock('Zend\ServiceManager\ServiceLocatorInterface');
        $this->sut = new StreamFactory();
    }

    protected function tearDown()
    {
        parent::tearDown();

        unset($this->sut);
    }

    public function testCreateService()
    {
        $config['api']['client_log'] = 'data/logs/apiclient.log';
        $this->serviceLocator->expects($this->any())
            ->method('get')
            ->will($this->returnValueMap(array(
                array('Config', $config)
            )));
        $this->sut->createService($this->serviceLocator);
    }
}
 