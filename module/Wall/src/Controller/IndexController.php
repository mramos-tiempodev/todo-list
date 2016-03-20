<?php
namespace Wall\Controller;

use Api\Client\ApiClient;
use User\Entity\User;
use Zend\Http\Response;
use Zend\Hydrator\ClassMethods;
use Zend\Mvc\Controller\AbstractActionController;

class IndexController extends AbstractActionController
{
    /** @var ApiClient */
    private $apiClient;

    /** @var User */
    private $user;

    /** @var  ClassMethods */
    private $hydrator;

    /**
     * @param User $user
     * @param ApiClient $apiClient
     * @param ClassMethods $hydrator
     */
    public function __construct(User $user, ApiClient $apiClient, ClassMethods $hydrator)
    {
        $this->setUser($user);
        $this->setApiClient($apiClient);
        $this->setHydrator($hydrator);
    }

    /**
     * @return array
     */
    public function indexAction()
    {
        $user = null;
        $viewData = array();
        $userName = $this->params()->fromRoute('username');
        $this->layout()->username = $userName;

        $response = $this->getApiClient()->getWall($userName);
        if($response) {
            $user = $this->getHydrator($this->getHydrator()->hydrate($response, $this->getUser()));
        } else {
            /** @var Response $response */
            $response = $this->getResponse();
            $response->setStatusCode(404);
        }
        $viewData['profileData'] = $user;

        return $viewData;
    }

    /**
     * @return User
     */
    private function getUser()
    {
        return $this->user;
    }

    /**
     * @param User $user
     */
    private function setUser($user)
    {
        $this->user = $user;
    }

    /**
     * @return ApiClient
     */
    private function getApiClient()
    {
        return $this->apiClient;
    }

    /**
     * @param ApiClient $apiClient
     */
    private function setApiClient($apiClient)
    {
        $this->apiClient = $apiClient;
    }

    /**
     * @return ClassMethods
     */
    private function getHydrator()
    {
        return $this->hydrator;
    }

    /**
     * @param ClassMethods $hydrator
     */
    private function setHydrator($hydrator)
    {
        $this->hydrator = $hydrator;
    }
} 