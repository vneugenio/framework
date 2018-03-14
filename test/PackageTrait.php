<?php

namespace Cradle\Framework;

use StdClass;
use PHPUnit\Framework\TestCase;

/**
 * Generated by PHPUnit_SkeletonGenerator on 2016-07-27 at 13:49:45.
 */
class Cradle_Frame_PackageTrait_Test extends TestCase
{
    /**
     * @var PackageTrait
     */
    protected $object;

    /**
     * Sets up the fixture, for example, opens a network connection.
     * This method is called before a test is executed.
     */
    protected function setUp()
    {
        $this->object = new PackageTraitStub;
    }

    /**
     * Tears down the fixture, for example, closes a network connection.
     * This method is called after a test is executed.
     */
    protected function tearDown()
    {
    }

    /**
     * covers Cradle\Framework\PackageTrait::isPackage
     */
    public function testIsPackage()
    {
        $actual = $this->object->isPackage('foobar');
        $this->assertFalse($actual);

        $actual = $this->object->register('foobar')->isPackage('foobar');
        $this->assertTrue($actual);
    }

    /**
     * covers Cradle\Framework\PackageTrait::package
     */
    public function testPackage()
    {
        $instance = $this->object->register('foobar')->package('foobar');
        $this->assertInstanceOf('Cradle\Framework\Package', $instance);

        $trigger = false;
        try {
            $this->object->package('barfoo');
        } catch(Exception $e) {
            $trigger = true;
        }
    }

    /**
     * covers Cradle\Framework\PackageTrait::register
     * covers Cradle\Framework\PackageTrait::package
     */
    public function testRegister()
    {
        //pseudo
        $instance = $this->object->register('foobar')->package('foobar');
        $this->assertInstanceOf('Cradle\Framework\Package', $instance);

        //root
        $instance = $this->object->register('/foo/bar')->package('/foo/bar');
        $this->assertInstanceOf('Cradle\Framework\Package', $instance);

        //vendor
        $instance = $this->object->register('foo/bar')->package('foo/bar');
        $this->assertInstanceOf('Cradle\Framework\Package', $instance);
    }

    /**
     * covers Cradle\Framework\PackageTrait::setBoostrapFile
     */
    public function testSetBoostrapFile()
    {
        $instance = $this->object->setBootstrapFile('foobar');
        $this->assertInstanceOf('Cradle\Framework\PackageTraitStub', $instance);
    }
}

if(!class_exists('Cradle\Frame\PackageTraitStub')) {
    class PackageTraitStub
    {
        use PackageTrait;
    }
}
