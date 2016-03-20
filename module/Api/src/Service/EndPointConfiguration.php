<?php
namespace Api\Service;

use Zend\Stdlib\AbstractOptions;

class EndPointConfiguration extends AbstractOptions
{
    /** @var string */
    private $host;

    /** @var string */
    private $wall;

    /**
     * @return string
     */
    public function getHost()
    {
        return $this->host;
    }

    /**
     * @param string $host
     */
    public function setHost($host)
    {
        $this->host = $host;
    }

    /**
     * @return string
     */
    public function getWall()
    {
        return $this->wall;
    }

    /**
     * @param string $wall
     */
    public function setWall($wall)
    {
        $this->wall = $wall;
    }

} 