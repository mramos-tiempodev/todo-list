<?php
namespace Task\Controller;

use Zend\Json\Json;
use Zend\Mvc\Controller\AbstractActionController;
use Zend\View\Model\JsonModel;
use Zend\Http\Client as HttpClient;
use Zend\View\Model\ViewModel;

class TaskclientController extends AbstractActionController
{

    public function indexAction()
    {
        $client = new HttpClient();
        $client->setAdapter('Zend\Http\Client\Adapter\Curl');
        $client->setUri('http://wizeline.webchallange.com/api/task');
        $client->setMethod('GET');
        $response = $client->send();

        return new ViewModel(array('task'=> $response->getContent()));
    }

    public function insertAction()
    {
        $request = $this->getRequest();
        $post = array();

        if ($request->isPost()) {
            parse_str($request->getContent(), $post);
        }

        $client = new HttpClient();
        $client->setAdapter('Zend\Http\Client\Adapter\Curl');
        $client->setUri('http://wizeline.webchallange.com/api/task');
        $client->setMethod('POST');
        $client->setParameterPOST($post);
        $response = $client->send();

        if (!$response->isSuccess()) {
            // report failure
            $message = $response->getStatusCode() . ': ' . $response->getReasonPhrase();

            $return = array('result' => false, 'error' => $message);
        } else {
            $return = array('result' => true, 'data' => $response->getContent(), 'errors' => null);
        }

        return new JsonModel($return);
    }

    public function updateAction()
    {
        //pending
    }
} 