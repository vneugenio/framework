<?php

namespace Cradle\I18n;

use PHPUnit_Framework_TestCase;

/**
 * Generated by PHPUnit_SkeletonGenerator on 2016-07-27 at 02:11:01.
 */
class Cradle_I18n_Timezone_Test extends PHPUnit_Framework_TestCase
{
    /**
     * @var Timezone
     */
    protected $object;

    /**
     * Sets up the fixture, for example, opens a network connection.
     * This method is called before a test is executed.
     */
    protected function setUp()
    {
        date_default_timezone_set('GMT');
        $this->object = new Timezone('Asia/Manila');
    }

    /**
     * Tears down the fixture, for example, closes a network connection.
     * This method is called after a test is executed.
     */
    protected function tearDown()
    {
    }

    /**
     * @covers Cradle\I18n\Timezone::__construct
     * @covers Cradle\I18n\Timezone::calculateOffset
     */
    public function test__construct()
    {
        $this->object->__construct('Asia/Manila');
    }

    /**
     * @covers Cradle\I18n\Timezone::convertTo
     */
    public function testConvertTo()
    {
        //zone = Asia/Manila, time = 1358756901, date = January 21, 2013 8:28AM
        //zone = America/Los_Angeles, time = ?, date = January 20, 2013 5:28PM

        $date = $this
            ->object
            ->setTime(1358756901)
            ->convertTo('America/Los_Angeles', 'F d, Y g:iA');

        $this->assertEquals('January 20, 2013 5:28PM', $date);

        $time = $this
            ->object
            ->setTime(1358756901)
            ->convertTo('America/Los_Angeles');

        $this->assertEquals(1358702901, $time);
    }

    /**
     * @covers Cradle\I18n\Timezone::getGMT
     */
    public function testGetGMT()
    {
        $gmt = $this->object->getGMT();
        $this->assertEquals('GMT+800', $gmt);
    }

    /**
     * @covers Cradle\I18n\Timezone::getGMTDates
     */
    public function testGetGMTDates()
    {
        $dates = $this->object->getGMTDates('F d, Y g:iA', 60);
        $this->assertEquals(25, count($dates));
        $this->assertArrayHasKey('GMT+800', $dates);
    }

    /**
     * @covers Cradle\I18n\Timezone::getOffset
     */
    public function testGetOffset()
    {
        $offset = $this->object->getOffset();
        $this->assertEquals(28800, $offset);
    }

    /**
     * @covers Cradle\I18n\Timezone::getOffsetDates
     */
    public function testGetOffsetDates()
    {
        $dates = $this->object->getOffsetDates('F d, Y g:iA', 60);
        $this->assertEquals(25, count($dates));
        $this->assertArrayHasKey('28800', $dates);
    }

    /**
     * @covers Cradle\I18n\Timezone::getTime
     */
    public function testGetTime()
    {
        $date = $this
            ->object
            ->setTime(1358756901)
            ->getTime('F d, Y g:iA');

        $this->assertEquals('January 21, 2013 8:28AM', $date);

        $time = $this
            ->object
            ->setTime(1358756901)
            ->getTime();

        $this->assertEquals(1358756901, $time);
    }

    /**
     * @covers Cradle\I18n\Timezone::getUTC
     */
    public function testGetUTC()
    {
        $utc = $this->object->getUTC();
        $this->assertEquals('UTC+8:00', $utc);
    }

    /**
     * @covers Cradle\I18n\Timezone::getUTCDates
     */
    public function testGetUTCDates()
    {
        $dates = $this->object->getUTCDates('F d, Y g:iA', 60);
        $this->assertEquals(25, count($dates));
        $this->assertArrayHasKey('UTC+8:00', $dates);
    }

    /**
     * @covers Cradle\I18n\Timezone::toRelative
     */
    public function testToRelative()
    {
        $class = new Timezone('America/Los_Angeles', time() - 0);

        $offset = $class->getOffset();

        $this->assertEquals('Now', $class->toRelative(time() - $offset));

        ///
        $class = new Timezone('America/Los_Angeles', time() - 15);
        $this->assertEquals('15 seconds ago', $class->toRelative(time() - $offset));

        ///
        $class = new Timezone('America/Los_Angeles', time() - 3602);
        $this->assertEquals('1 hour ago', $class->toRelative(time() - $offset));

        ///
        $class = new Timezone('America/Los_Angeles', time() + 2);
        $this->assertEquals('Now', $class->toRelative(time() - $offset));

        ///
        $class = new Timezone('America/Los_Angeles', time() + 15);
        $this->assertEquals('15 seconds from now', $class->toRelative(time() - $offset));

        ///
        $class = new Timezone('America/Los_Angeles', time() + 3602);
        $this->assertEquals('1 hour from now', $class->toRelative(time() - $offset));

        $class = new Timezone('America/Los_Angeles', time() + $offset);
        $this->assertEquals('Now', $class->toRelative());

        $class = new Timezone('America/Los_Angeles', time());
        $this->assertEquals('Now', $class->toRelative(date('Y-m-d H:i:s', time() - $offset)));

        $class = new Timezone('America/Los_Angeles', time());
        $this->assertEquals('7 hours from now', $class->toRelative(time() + 45, 4));

        $class = new Timezone('America/Los_Angeles', time());
        $this->assertEquals(date('F d, Y', time() - $offset), $class->toRelative(time() + 1, 1));

        ///
        $class = new Timezone('America/Los_Angeles', time() - (60 * 60 * 25));
        $this->assertEquals('Yesterday', $class->toRelative(time() - $offset));

        ///
        $class = new Timezone('America/Los_Angeles', time() + (60 * 60 * 25));
        $this->assertEquals('Tomorrow', $class->toRelative(time() - $offset));
    }

    /**
     * @covers Cradle\I18n\Timezone::setTime
     */
    public function testSetTime()
    {
        $instance = $this
            ->object
            ->setTime(1358756901);

        $this->assertInstanceOf('Cradle\I18n\Timezone', $instance);

        $instance = $this
            ->object
            ->setTime('January 21, 2013 8:28AM');

        $this->assertInstanceOf('Cradle\I18n\Timezone', $instance);
    }

    /**
     * @covers Cradle\I18n\Timezone::__callResolver
     */
    public function test__callResolver()
    {
        $actual = $this->object->__callResolver(ResolverCallStub::class, [])->foo('bar');
        $this->assertEquals('barfoo', $actual);
    }

    /**
     * @covers Cradle\I18n\Timezone::addResolver
     */
    public function testAddResolver()
    {
        $actual = $this->object->addResolver(ResolverCallStub::class, function() {});
        $this->assertInstanceOf('Cradle\I18n\Timezone', $actual);
    }

    /**
     * @covers Cradle\I18n\Timezone::getResolverHandler
     */
    public function testGetResolverHandler()
    {
        $actual = $this->object->getResolverHandler();
        $this->assertInstanceOf('Cradle\Resolver\ResolverInterface', $actual);
    }

    /**
     * @covers Cradle\I18n\Timezone::resolve
     */
    public function testResolve()
    {
        $actual = $this->object->addResolver(
            ResolverCallStub::class,
            function() {
                return new ResolverAddStub();
            }
        )
        ->resolve(ResolverCallStub::class)
        ->foo('bar');

        $this->assertEquals('barfoo', $actual);
    }

    /**
     * @covers Cradle\I18n\Timezone::resolveShared
     */
    public function testResolveShared()
    {
        $actual = $this
            ->object
            ->resolveShared(ResolverSharedStub::class)
            ->reset()
            ->foo('bar');

        $this->assertEquals('barfoo', $actual);

        $actual = $this
            ->object
            ->resolveShared(ResolverSharedStub::class)
            ->foo('bar');

        $this->assertEquals('barbar', $actual);
    }

    /**
     * @covers Cradle\I18n\Timezone::resolveStatic
     */
    public function testResolveStatic()
    {
        $actual = $this
            ->object
            ->resolveStatic(
                ResolverStaticStub::class,
                'foo',
                'bar'
            );

        $this->assertEquals('barfoo', $actual);
    }

    /**
     * @covers Cradle\I18n\Timezone::setResolverHandler
     */
    public function testSetResolverHandler()
    {
        $actual = $this->object->setResolverHandler(new ResolverHandlerStub);
        $this->assertInstanceOf('Cradle\I18n\Timezone', $actual);
    }

    /**
     * @covers Cradle\I18n\Timezone::i
     */
    public function testI()
    {
        $instance1 = Timezone::i('America/Los_Angeles');
        $this->assertInstanceOf('Cradle\I18n\Timezone', $instance1);

        $instance2 = Timezone::i('America/Los_Angeles');
        $this->assertTrue($instance1 !== $instance2);
    }
}

if(!class_exists('Cradle\I18n\ResolverCallStub')) {
    class ResolverCallStub
    {
        public function foo($string)
        {
            return $string . 'foo';
        }
    }
}

if(!class_exists('Cradle\I18n\ResolverAddStub')) {
    class ResolverAddStub
    {
        public function foo($string)
        {
            return $string . 'foo';
        }
    }
}

if(!class_exists('Cradle\I18n\ResolverSharedStub')) {
    class ResolverSharedStub
    {
        public $name = 'foo';

        public function foo($string)
        {
            $name = $this->name;
            $this->name = $string;
            return $string . $name;
        }

        public function reset()
        {
            $this->name = 'foo';
            return $this;
        }
    }
}

if(!class_exists('Cradle\I18n\ResolverStaticStub')) {
    class ResolverStaticStub
    {
        public static function foo($string)
        {
            return $string . 'foo';
        }
    }
}

if(!class_exists('Cradle\I18n\ResolverHandlerStub')) {
    class ResolverHandlerStub extends ResolverHandler
    {
    }
}
