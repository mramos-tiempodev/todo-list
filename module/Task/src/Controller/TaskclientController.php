<?php
namespace Task\Controller;

use Zend\Json\Json;
use Zend\Mvc\Controller\AbstractActionController;
use Zend\View\Model\JsonModel;
use Zend\Http\Client as HttpClient;
use Zend\View\Model\ViewModel;

/**
 * Used to receive all the calls from the frontend of the app
 */
class TaskclientController extends AbstractActionController
{

	const URL_INDEX_ACTION = 'http://tiempo.todolist.com/api/task';
	const URL_INSERT_ACTION = 'http://tiempo.todolist.com/api/task';

    public function indexAction()
    {
        $client = new HttpClient();
        $client->setAdapter('Zend\Http\Client\Adapter\Curl');
        $client->setUri(self::URL_INDEX_ACTION);
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
        $client->setUri(self::URL_INSERT_ACTION);
        $client->setMethod('POST');
        $client->setParameterPOST($post);
        $response = $client->send();

        if (!$response->isSuccess()) {
            // report failure
            $message = $response->getStatusCode() . ': ' . $response->getReasonPhrase();
            $return = array('result' => false, 'error' => $message);
        } else {
            $hello = json_decode($response->getContent());
            $return = array($hello);
        }

        return new JsonModel($return);
    }
} 