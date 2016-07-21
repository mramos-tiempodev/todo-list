<?php
namespace Task\Options;

/**
 * Used to map each database field in a class
 */
class Task
{

    public $id;
    public $name;
    public $status;

    /**
     * @param array $data
     */
    public function exchangeArray($data)
    {
        $this->id = (isset($data['id'])) ? $data['id'] : null;
        $this->name = (isset($data['name'])) ? $data['name'] : null;
        $this->status = (isset($data['status'])) ? $data['status'] : null;
    }

    public function getArrayCopy()
    {
        return get_object_vars($this);
    }
}
