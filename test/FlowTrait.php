<?php

namespace Cradle\Framework;

use PHPUnit_Framework_TestCase;
use Cradle\Http\Request;
use Cradle\Http\Response;

/**
 * Generated by PHPUnit_SkeletonGenerator on 2016-07-27 at 13:49:45.
 */
class Cradle_Framework_FlowTrait_Test extends PHPUnit_Framework_TestCase
{
    /**
     * @var FlowTrait
     */
    protected $object;

    /**
     * Sets up the fixture, for example, opens a network connection.
     * This method is called before a test is executed.
     */
    protected function setUp()
    {
        $this->object = new FlowTraitStub;
    }

    /**
     * Tears down the fixture, for example, closes a network connection.
     * This method is called after a test is executed.
     */
    protected function tearDown()
    {
    }

    /**
     * @covers Cradle\Framework\FlowTrait::__callFlow
     */
    public function test__callFlow()
    {
        $this->object->__callFlow('foo', array());
        $callback = $this->object->__callFlow('bar', array());

        $this->assertInstanceOf('Closure', $callback);

        $this->assertEquals('bar', $callback(new Request, new Response));
    }

    /**
     * @covers Cradle\Framework\FlowTrait::__getFlow
     */
    public function test__getFlow()
    {
        $this->object->__getFlow('foo', array());
        $callback = $this->object->__getFlow('bar', array());

        $this->assertInstanceOf('Closure', $callback);

        $this->assertEquals('bar', $callback(new Request, new Response));
    }
}
if(!class_exists('Cradle\Framework\ActionStub')) {
    class ActionStub
    {
        public function bar()
        {
            return 'bar';
        }
    }
}

if(!class_exists('Cradle\Framework\FlowTraitStub')) {
    class FlowTraitStub
    {
        use FlowTrait;

        public function __construct()
        {
            $this->actions['foo'] = new ActionStub;
        }
    }
}
