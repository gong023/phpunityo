<?php

namespace PHPUnityo;

/**
 * Class YoClientTest
 *
 * @package PHPUnityo
 */
class FunctionalTest extends \PHPUnit_Framework_TestCase
{
    public function testSuccess()
    {
        $this->assertTrue(true);
    }

    public function testFail()
    {
        $this->fail();
    }
}
