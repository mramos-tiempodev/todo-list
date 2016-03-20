<?php
namespace UnitTest\Api\Client;

use Api\Client\ApiClientFactory;
use Api\Service\EndPointConfiguration;
use Api\Service\JsonDecoder;
use PHPUnit_Framework_MockObject_MockObject;
use Zend\Http\Client;
use Zend\Log\Logger;
use Zend\Log\Writer\Stream;
use Zend\ServiceManager\ServiceLocatorInterface;
use Zend\Session\Container;

class ApiClientFactoryTest extends \PHPUnit_Framework_TestCase
{
    /** @var ApiClientFactory */
    private $sut;

    /** @var ServiceLocatorInterface|PHPUnit_Framework_MockObject_MockObject */
    private $serviceLocator;

    /** @var Client|PHPUnit_Framework_MockObject_MockObject */
    private $client;

    /** @var Container|PHPUnit_Framework_MockObject_MockObject */
    private $session;

    /** @var Logger|PHPUnit_Framework_MockObject_MockObject */
    private $logger;

    /** @var Stream|PHPUnit_Framework_MockObject_MockObject */
    private $stream;

    /** @var JsonDecoder|PHPUnit_Framework_MockObject_MockObject */
    private $decoder;

    /** @var EndPointConfiguration|PHPUnit_Framework_MockObject_MockObject */
    private $endPointConfiguration;

    protected function setUp()
    {
        parent::setUp();

        $this->client = $this->getMockBuilder('Zend\Http\Client')->disableOriginalConstructor()->getMock();
        $this->session = $this->getMockBuilder('Zend\Session\Container')->disableOriginalConstructor()->getMock();
        $this->logger = $this->getMockBuilder('Zend\Log\Logger')->disableOriginalConstructor()->getMock();
        $this->stream = $this->getMockBuilder('Zend\Log\Writer\Stream')->disableOriginalConstructor()->getMock();
        $this->decoder = $this->getMockBuilder('Api\Service\JsonDecoder')->disableOriginalConstructor()->getMock();
        $this->endPointConfiguration = $this->getMockBuilder('Api\Service\EndPointConfiguration')
            ->disableOriginalConstructor()
            ->getMock();
        $this->serviceLocator = $this->getMock('Zend\ServiceManager\ServiceLocatorInterface');
        $this->sut = new ApiClientFactory();
    }

    protected function tearDown()
    {
        parent::tearDown();

        unset($this->sut);
        unset($this->serviceLocator);
        unset($this->client);
        unset($this->session);
        unset($this->logger);
        unset($this->stream);
        unset($this->decoder);
        unset($this->endPointConfiguration);
    }

    public function testCreateService()
    {
        $this->serviceLocator->expects($this->any())
            ->method('get')
            ->will($this->returnValueMap(array(
                array('Zend\Http\Client', $this->client),
                array('Zend\Session\Container', $this->session),
                array('Zend\Log\Logger', $this->logger),
                array('Api\Service\Stream', $this->stream),
                array('Api\Service\JsonDecoder', $this->decoder),
                array('Api\Service\EndPointConfiguration', $this->endPointConfiguration),
            )));
        $actual = $this->sut->createService($this->serviceLocator);
        $this->assertInstanceOf('Api\Client\ApiClient', $actual);
    }
}
