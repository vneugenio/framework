<?php

namespace Cradle\Framework;

use PHPUnit_Framework_TestCase;

/**
 * Generated by PHPUnit_SkeletonGenerator on 2016-07-27 at 13:49:45.
 */
class Cradle_Framework_Exception_Test extends PHPUnit_Framework_TestCase
{
    /**
     * @var FrameException
     */
    protected $object;

    /**
     * Sets up the fixture, for example, opens a network connection.
     * This method is called before a test is executed.
     */
    protected function setUp()
    {
        $this->object = new Exception;
    }

    /**
     * Tears down the fixture, for example, closes a network connection.
     * This method is called after a test is executed.
     */
    protected function tearDown()
    {
    }

    /**
     * @covers Cradle\Framework\Exception::forPackageNotFound
     */
    public function testForPackageNotFound()
    {
		$message = null;

		try {
			throw Exception::forPackageNotFound('foobar');
		} catch(Exception $e) {
			$message = $e->getMessage();
		}

		$this->assertEquals('Could not find package: foobar', $message);
    }

    /**
     * @covers Cradle\Framework\Exception::forMethodNotFound
     */
    public function testForMethodNotFound()
    {
		$message = null;

		try {
			throw Exception::forMethodNotFound('foobar');
		} catch(Exception $e) {
			$message = $e->getMessage();
		}

		$this->assertEquals('No method named foobar was found', $message);
    }
}
