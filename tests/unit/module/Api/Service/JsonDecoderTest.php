<?php
namespace UnitTest\Api\Service;

use Api\Service\JsonDecoder;

class JsonDecoderTest extends \PHPUnit_Framework_TestCase
{
    /** @var JsonDecoder */
    private $sut;

    protected function setUp()
    {
        parent::setUp();

        $this->sut = new JsonDecoder();
    }

    protected function tearDown()
    {
        parent::tearDown();

        unset($this->sut);
    }

    public function testDecode()
    {
        $actual = $this->sut->decode('{"a":1,"b":2,"c":3,"d":4,"e":5}',1);
        $this->assertInternalType('array', $actual);
    }

}
 