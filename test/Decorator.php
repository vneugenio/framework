<?php

namespace Cradle\Framework;

use PHPUnit_Framework_TestCase;
use Cradle\Resolver\ResolverException;

Decorator::DECORATE;

/**
 * Generated by PHPUnit_SkeletonGenerator on 2016-07-27 at 13:49:45.
 */
class Cradle_Framework_Decorator_Test extends PHPUnit_Framework_TestCase
{
    /**
     * @var Decorator
     */
    protected $object;

    /**
     * Sets up the fixture, for example, opens a network connection.
     * This method is called before a test is executed.
     */
    protected function setUp()
    {
    }

    /**
     * Tears down the fixture, for example, closes a network connection.
     * This method is called after a test is executed.
     */
    protected function tearDown()
    {
    }

    /**
     * @covers cradle()
     */
    public function testCradle()
    {
        $this->assertInstanceOf('Cradle\Framework\App', cradle());
        $this->assertInstanceOf('Cradle\Framework\Package', cradle('global'));
        $this->assertEquals('foobar', cradle(function() {
            return 'foobar';
        }));

        $trigger = false;
        try {
            cradle('foobar');
        } catch(ResolverException $e) {
            $trigger = true;
        }

        $this->assertTrue($trigger);
    }
}
