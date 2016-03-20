<?php
namespace Api\Client;

use Zend\Http\Client;
use Zend\Http\Request;
use Zend\Http\Response;
use Zend\Json\Json;

class ApiClient extends ApiClientAbstract
{

    /**
     * Perform an API request to retrieve the data of the wall
     * of an specific user on the social network
     *
     * @param string $username
     * @return Response|bool
     */
    public function getWall($username)
    {
        $endPointConfiguration = $this->getEndPointConfiguration();
        $url = $endPointConfiguration->getWall() . sprintf($endPointConfiguration->getHost(), $username);
        $client = $this->setDataToClient($url);
        return $this->doRequest($client);
    }

    /**
     * Perform a request to the API
     *
     * @param Client $client
     *
     * @return Response|bool
     */
    private function doRequest(Client $client)
    {
        /** @var Response $response */
        $response = $client->send();
        $result = false;
        if ($response->isSuccess()) {
            $result = $this->getDecoder()->decode($response->getBody(), Json::TYPE_ARRAY);
        } else {
            $logger = $this->getLogger();
            $logger->addWriter($this->getStream());
            $logger->debug($response->getBody());
        }

        return $result;
    }

    /**
     * @param string $url
     * @param array $postData
     * @param string $method
     *
     * @return Client
     */
    private function setDataToClient($url, array $postData = array(), $method = Request::METHOD_GET)
    {
        $client = $this->getHttpClient();
        $client->resetParameters();
        $client->setEncType(Client::ENC_URLENCODED);
        $client->setUri($url);
        $client->setMethod($method);

        $postData['access_token'] = $this->getSessionContainer()->accessToken;

        if (
            ($method == Request::METHOD_POST || $method == Request::METHOD_GET || $method == Request::METHOD_DELETE)
            && $postData !== null
        ) {
            $client->setParameterGet($postData);
        }
        return $client;
    }
} 