<?php
namespace Api\Service;


use Zend\Json\Decoder;

class JsonDecoder
{

    /**
     * @param string $source
     * @param int $jsonType
     *
     * @return mixed
     */
    public function decode($source, $jsonType)
    {
        return Decoder::decode($source, $jsonType);
    }
} 