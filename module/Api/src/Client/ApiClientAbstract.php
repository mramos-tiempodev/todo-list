<?php
namespace Api\Client;

use Api\Service\EndPointConfiguration;
use Api\Service\JsonDecoder;
use Zend\Http\Client;
use Zend\Http\Response;
use Zend\Log\Logger;
use Zend\Log\Writer\Stream;
use Zend\Session\Container as SessionContainer;

abstract class ApiClientAbstract
{
    /** @var Client */
    private $httpClient;

    /** @var SessionContainer */
    private $sessionContainer;

    /** @var Logger */
    private $logger;

    /** @var Stream */
    private $stream;

    /** @var JsonDecoder */
    private $decoder;

    /** @var EndPointConfiguration */
    private $endPointConfiguration;

    /**
     * @param Client $httpClient
     * @param SessionContainer $sessionContainer
     * @param Logger $logger
     * @param Stream $stream
     * @param JsonDecoder $decoder
     * @param EndPointConfiguration $endPointConfiguration
     */
    public function __construct(
        Client $httpClient,
        SessionContainer $sessionContainer,
        Logger $logger,
        Stream $stream,
        JsonDecoder $decoder,
        EndPointConfiguration $endPointConfiguration
    ) {
        $this->setHttpClient($httpClient);
        $this->setSessionContainer($sessionContainer);
        $this->setLogger($logger);
        $this->setStream($stream);
        $this->setDecoder($decoder);
        $this->setEndPointConfiguration($endPointConfiguration);
    }

    /**
     * @return Client
     */
    protected function getHttpClient()
    {
        return $this->httpClient;
    }

    /**
     * @param Client $httpClient
     */
    protected function setHttpClient($httpClient)
    {
        $this->httpClient = $httpClient;
    }

    /**
     * @return Stream
     */
    protected function getStream()
    {
        return clone $this->stream;
    }

    /**
     * @param Stream $stream
     */
    protected function setStream($stream)
    {
        $this->stream = $stream;
    }

    /**
     * @return Logger
     */
    protected function getLogger()
    {
        return $this->logger;
    }

    /**
     * @param Logger $logger
     */
    protected function setLogger($logger)
    {
        $this->logger = $logger;
    }

    /**
     * @return SessionContainer
     */
    protected function getSessionContainer()
    {
        return $this->sessionContainer;
    }

    /**
     * @param SessionContainer $sessionContainer
     */
    protected function setSessionContainer($sessionContainer)
    {
        $this->sessionContainer = $sessionContainer;
    }

    /**
     * @return JsonDecoder
     */
    protected function getDecoder()
    {
        return $this->decoder;
    }

    /**
     * @param JsonDecoder $decoder
     */
    protected function setDecoder($decoder)
    {
        $this->decoder = $decoder;
    }

    /**
     * @return EndPointConfiguration
     */
    protected function getEndPointConfiguration()
    {
        return $this->endPointConfiguration;
    }

    /**
     * @param EndPointConfiguration $endPointConfiguration
     */
    protected function setEndPointConfiguration($endPointConfiguration)
    {
        $this->endPointConfiguration = $endPointConfiguration;
    }
} 