<?php

namespace Cradle\Framework;

use StdClass;
use PHPUnit_Framework_TestCase;

/**
 * Generated by PHPUnit_SkeletonGenerator on 2016-07-27 at 13:49:45.
 */
class Cradle_Frame_PackageTrait_Test extends PHPUnit_Framework_TestCase
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
    }

    /**
     * covers Cradle\Framework\PackageTrait::register
     */
    public function testRegister()
    {
		$instance = $this->object->register('foobar')->package('foobar');
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
