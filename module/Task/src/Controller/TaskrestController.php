<?php
namespace Task\Controller;

use Exception;
use Task\Model\Task as TaskModel;
use Zend\Http\PhpEnvironment\Response;
use Zend\Mvc\Controller\AbstractRestfulController;
use Zend\View\Model\JsonModel;

/**
 * Used to receive any call that came from outside
 */
class TaskrestController extends AbstractRestfulController
{

    /** @var TaskModel */
    private $taskModel;

    public function __construct(TaskModel $taskModel)
    {
        $this->setTaskModel($taskModel);
    }

    /**
     * @param array $data
     *
     * @return array
     */
    public function create($data)
    {
        try {
            $result = $this->getTaskModel()->saveTask($data);
            $data['id'] = $result;
        } catch(Exception $e) {
            $result = false;
            $error = $e->getMessage();
        }
        if ($result)
            $result = array('result' => true, 'data' => $data, 'errors' => null);
        else
            $result = array('result' => false, 'errors' => $error);

        return new JsonModel($result);
    }

    public function getList()
    {
        $results = $this->getTaskModel()->fetchAll();
        $data = array();
        foreach($results as $result) {
            $data[] = $result;
        }

        return new JsonModel($data);
    }

    /**
     * @param string $id
     *
     * @return mixed|void
     */
    public function get($id)
    {
        $this->methodNotAllowed();
    }

    /**
     * @param string $id
     * @param array $data
     *
     * @return mixed|void
     */
    public function update($id, $data)
    {
        //pending
    }

    /**
     * @param string $id
     *
     * @return mixed|void
     */
    public function delete($id)
    {
        $this->methodNotAllowed();
    }

    /**
     * This method is used to restrict the entry point for any call that try to connect
     */
    protected function methodNotAllowed()
    {
        $this->response->setStatusCode(Response::STATUS_CODE_405);
    }

    /**
     * @return TaskModel
     */
    private function getTaskModel()
    {
        return $this->taskModel;
    }

    /**
     * @param TaskModel $taskModel
     */
    private function setTaskModel(TaskModel $taskModel)
    {
        $this->taskModel = $taskModel;
    }


} 
