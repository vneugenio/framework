<?php

namespace Cradle\Http\Request;

use PHPUnit_Framework_TestCase;
use Cradle\Data\Registry;

/**
 * Generated by PHPUnit_SkeletonGenerator on 2016-07-28 at 11:36:34.
 */
class Cradle_Http_Request_ServerTrait_Test extends PHPUnit_Framework_TestCase
{
    /**
     * @var ServerTrait
     */
    protected $object;

    /**
     * Sets up the fixture, for example, opens a network connection.
     * This method is called before a test is executed.
     */
    protected function setUp()
    {
        $this->object = new ServerTraitStub;
    }

    /**
     * Tears down the fixture, for example, closes a network connection.
     * This method is called after a test is executed.
     */
    protected function tearDown()
    {
    }

    /**
     * covers Cradle\Http\Request\ServerTrait::getMethod
     */
    public function testGetMethod()
    {
        $this->object->set('method', 'foobar');
        $this->assertEquals('FOOBAR', $this->object->getMethod());
    }

    /**
     * covers Cradle\Http\Request\ServerTrait::getPath
     */
    public function testGetPath()
    {
        $this->object->setPath('/foo/bar');
        $this->assertEquals('/foo/bar', $this->object->getPath('string'));
    }

    /**
     * covers Cradle\Http\Request\ServerTrait::getQuery
     */
    public function testGetQuery()
    {
        $this->object->set('query', 'foobar');
        $this->assertEquals('foobar', $this->object->getQuery());
    }

    /**
     * covers Cradle\Http\Request\ServerTrait::getServer
     */
    public function testGetServer()
    {
        $this->object->set('server', array(
            'foo' => 'bar',
            'bar' => 'foo'
        ));
        
        $this->assertEquals('bar', $this->object->getServer('foo'));
    }

    /**
     * covers Cradle\Http\Request\ServerTrait::hasServer
     */
    public function testHasServer()
    {
        $this->object->set('server', array(
            'foo' => 'bar',
            'bar' => 'foo'
        ));
        
        $this->assertTrue($this->object->hasServer('foo'));
        $this->assertFalse($this->object->hasServer('zoo'));
    }

    /**
     * covers Cradle\Http\Request\ServerTrait::isMethod
     */
    public function testIsMethod()
    {
        $this->assertFalse($this->object->isMethod('foobar'));
        
        $this->object->setMethod('foobar');
        $this->assertTrue($this->object->isMethod('foobar'));
    }

    /**
     * covers Cradle\Http\Request\ServerTrait::setMethod
     */
    public function testSetMethod()
    {
        $instance = $this->object->setMethod('foobar');
        
        $this->assertInstanceOf('Cradle\Http\Request\ServerTraitStub', $instance);
    }

    /**
     * covers Cradle\Http\Request\ServerTrait::setPath
     */
    public function testSetPath()
    {
        $instance = $this->object->setPath('foobar');
        
        $this->assertInstanceOf('Cradle\Http\Request\ServerTraitStub', $instance);
    }

    /**
     * covers Cradle\Http\Request\ServerTrait::setQuery
     */
    public function testSetQuery()
    {
        $instance = $this->object->setQuery('foobar');
        
        $this->assertInstanceOf('Cradle\Http\Request\ServerTraitStub', $instance);
    }

    /**
     * covers Cradle\Http\Request\ServerTrait::setServer
     */
    public function testSetServer()
    {
        $instance = $this->object->setServer(array(
            'foo' => 'bar',
            'bar' => 'foo'
        ));
        
        $this->assertInstanceOf('Cradle\Http\Request\ServerTraitStub', $instance);
    }
}

if(!class_exists('Cradle\Http\Request\ServerTraitStub')) {
    class ServerTraitStub extends Registry
    {
        use ServerTrait;
    }
}