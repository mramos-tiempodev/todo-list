<?php
namespace UnitTest\Api\Service;

use Api\Service\EndPointConfiguration;

class EndPointConfigurationTest extends \PHPUnit_Framework_TestCase
{
    /** @var EndPointConfiguration */
    private $sut;

    protected function setUp()
    {
        parent::setUp();

        $options = array(
            'wall' => 1,
            'host' => 1
        );
        $this->sut = new EndPointConfiguration($options);
    }

    protected function tearDown()
    {
        parent::tearDown();

        unset($this->sut);
    }

    public function testOptions()
    {
        $this->assertEquals(1, $this->sut->getWall());
        $this->assertEquals(1, $this->sut->getHost());
    }
}
 