<?php
namespace UnitTest\Api\Client;

use Api\Client\ApiClient;
use Api\Service\EndPointConfiguration;
use Api\Service\JsonDecoder;
use PHPUnit_Framework_MockObject_MockObject;
use Zend\Http\Client;
use Zend\Http\Response;
use Zend\Log\Logger;
use Zend\Log\Writer\Stream;
use Zend\Session\Container;

class ApiClientTest extends \PHPUnit_Framework_TestCase
{
    /** @var ApiClient */
    private $sut;

    /** @var Client|PHPUnit_Framework_MockObject_MockObject */
    private $httpClient;

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

    /** @var Response|PHPUnit_Framework_MockObject_MockObject */
    private $response;

    protected function setUp()
    {
        parent::setUp();

        $this->httpClient = $this->getMockBuilder('Zend\Http\Client')->disableOriginalConstructor()->getMock();
        $this->session = $this->getMockBuilder('Zend\Session\Container')->disableOriginalConstructor()->getMock();
        $this->logger = $this->getMockBuilder('Zend\Log\Logger')->disableOriginalConstructor()->getMock();
        $this->stream = $this->getMockBuilder('Zend\Log\Writer\Stream')->disableOriginalConstructor()->getMock();
        $this->decoder = $this->getMockBuilder('Api\Service\JsonDecoder')->disableOriginalConstructor()->getMock();
        $this->endPointConfiguration = $this->getMockBuilder('Api\Service\EndPointConfiguration')
            ->disableOriginalConstructor()
            ->getMock();
        $this->response = $this->getMockBuilder('Zend\Http\Response')->disableOriginalConstructor()->getMock();
        $this->sut = new ApiClient(
            $this->httpClient,
            $this->session,
            $this->logger,
            $this->stream,
            $this->decoder,
            $this->endPointConfiguration
        );
    }

    protected function tearDown()
    {
        parent::tearDown();

        unset($this->sut);
        unset($this->httpClient);
        unset($this->session);
        unset($this->logger);
        unset($this->stream);
        unset($this->decoder);
        unset($this->endPointConfiguration);
    }

    public function testGetWallNotSuccess()
    {
        $this->expectsForEndPointConfiguration();
        $this->expectsForClient();
        $this->response->expects($this->any())
            ->method('isSuccess')
            ->will($this->returnValue(false));
        $this->expectsForLogger();
        $this->response->expects($this->any())
            ->method('getBody')
            ->will($this->returnValue('x'));
        $actual = $this->sut->getWall('x');

        $this->assertFalse($actual);
    }

    public function testGetWall()
    {
        $this->expectsForEndPointConfiguration();
        $this->expectsForClient();
        $this->response->expects($this->any())
            ->method('isSuccess')
            ->will($this->returnValue(true));
        $this->decoder->expects($this->any())
            ->method('decode')
            ->will($this->returnValue('x'));
        $this->response->expects($this->any())
            ->method('getBody')
            ->will($this->returnValue('x'));
        $actual = $this->sut->getWall('x');

        $this->assertEquals('x', $actual);
    }

    private function expectsForEndPointConfiguration()
    {
        $this->endPointConfiguration->expects($this->any())
            ->method('getWall')
            ->will($this->returnValue('x'));
        $this->endPointConfiguration->expects($this->any())
            ->method('getHost')
            ->will($this->returnValue('x'));
    }

    private function expectsForClient()
    {
        $this->httpClient->expects($this->any())
            ->method('resetParameters');
        $this->httpClient->expects($this->any())
            ->method('setEncType');
        $this->httpClient->expects($this->any())
            ->method('setUri');
        $this->httpClient->expects($this->any())
            ->method('setMethod');
        $this->httpClient->expects($this->any())
            ->method('send')
            ->will($this->returnValue($this->response));
    }

    private function expectsForLogger()
    {
        $this->logger->expects($this->any())
            ->method('addWriter');
        $this->logger->expects($this->any())
            ->method('debug');
    }
} 