<?php

namespace Cradle\Framework;

use StdClass;
use PHPUnit_Framework_TestCase;
use Cradle\Http\Request;
use Cradle\Event\EventHandler;

/**
 * Generated by PHPUnit_SkeletonGenerator on 2016-07-27 at 13:49:45.
 */
class Cradle_Framework_App_Test extends PHPUnit_Framework_TestCase
{
    /**
     * @var App
     */
    protected $object;

    /**
     * Sets up the fixture, for example, opens a network connection.
     * This method is called before a test is executed.
     */
    protected function setUp()
    {
        $this->object = new App;
        $this->object->setEventHandler(new EventHandler);
    }

    /**
     * Tears down the fixture, for example, closes a network connection.
     * This method is called after a test is executed.
     */
    protected function tearDown()
    {
    }

    /**
     * @covers Cradle\Framework\App::__invoke
     */
    public function test__invoke()
    {
        $actual = $this->object->__invoke('global');
        $this->assertInstanceOf('Cradle\Framework\Package', $actual);
    }

    /**
     * @covers Cradle\Framework\App::all
     */
    public function testAll()
    {
        $instance = $this->object->all('/foo/bar', function() {});
        $this->assertInstanceOf('Cradle\Framework\App', $instance);
    }

    /**
     * @covers Cradle\Framework\App::app
     */
    public function testApp()
    {
        $request = new Request();
        $request->setPath('/foo/bar')->setMethod('GET');
        $app = new App;
        $trigger = new StdClass;
        $trigger->success = false;
        $app->get('/bar', function() use ($trigger) {
            $trigger->success = true;
        });

        $this->object->setRequest($request);
        $this->object->app('/foo', $app)->process();

        $this->assertTrue($trigger->success);

        $request->setPath('/');
        $app = new App;
        $trigger = new StdClass;
        $trigger->success = false;
        $app->get('/', function() use ($trigger) {
            $trigger->success = true;
        });

        $this->object->setRequest($request);
        $this->object->app('/', $app)->process();

        $this->assertTrue($trigger->success);
    }

    /**
     * @covers Cradle\Framework\App::delete
     */
    public function testDelete()
    {
        $instance = $this->object->delete('/foo/bar', function() {});
        $this->assertInstanceOf('Cradle\Framework\App', $instance);
    }

    /**
     * @covers Cradle\Framework\App::get
     */
    public function testGet()
    {
        $instance = $this->object->get('/foo/bar', function() {});
        $this->assertInstanceOf('Cradle\Framework\App', $instance);
    }

    /**
     * @covers Cradle\Framework\App::getPackages
     */
    public function testGetPackages()
    {
        $packages = $this->object->getPackages();
        $this->assertTrue(is_array($packages));
    }

    /**
     * @covers Cradle\Framework\App::getProtocols
     */
    public function testGetProtocols()
    {
        $protocols = $this->object->getProtocols();
        $this->assertTrue(is_array($protocols));
    }

    /**
     * @covers Cradle\Framework\App::import
     */
    public function testImport()
    {
        $trigger = new StdClass();
        $trigger->success1 = null;
        $trigger->success2 = null;
        $trigger->success3 = null;
        $trigger->total = 0;

        $instance = $this
            ->object
            ->import(array(
                array(
                    'foobar',
                    'step1',
                    'step2',
                    'step3'
                )
            ))
            ->on('step1', function($trigger, $foo, $bar) {
                $foo += 1;
                $bar += 2;
                $trigger->success1 = true;
                $trigger->total += $foo + $bar;
            })
            ->on('step2', function($trigger, $foo, $bar) {
                $foo += 1;
                $bar += 2;
                $trigger->success2 = true;
                $trigger->total += $foo + $bar;
            })
            ->on('step3', function($trigger, $foo, $bar) {
                $foo += 1;
                $bar += 2;
                $trigger->success3 = true;

                $trigger->total += $foo + $bar;
            })
            ->trigger('foobar', $trigger, 1, 2);

        $this->assertInstanceOf('Cradle\Framework\App', $instance);
        $this->assertTrue($trigger->success1);
        $this->assertTrue($trigger->success2);
        $this->assertTrue($trigger->success3);
        $this->assertEquals(18, $trigger->total);
    }

    /**
     * @covers Cradle\Framework\App::export
     */
    public function testExport()
    {
        $trigger = new StdClass();
        $trigger->success1 = null;
        $trigger->success2 = null;
        $trigger->success3 = null;
        $trigger->success4 = null;

        list($request, $response, $next) = $this
            ->object
            ->flow(
                'foobar',
                'step1',
                'step2',
                'step3'
            )
            ->on('step1', function($request, $response, $trigger) {
                $trigger->success1 = true;

            })
            ->on('step2', function($request, $response, $trigger) {
                $trigger->success2 = true;
            })
            ->on('step3', function($request, $response, $trigger) {
                $trigger->success3 = true;
            })
            ->export('foobar', true);

        $actual = $next($trigger);

        $this->assertTrue($trigger->success1);
        $this->assertTrue($trigger->success2);
        $this->assertTrue($trigger->success3);

        $trigger = new StdClass();
        $trigger->success1 = null;
        $trigger->success2 = null;
        $trigger->success3 = null;

        list($request, $response, $next) = $this
            ->object
            ->flow(
                'bar2foo',
                'step1',
                'step2',
                'step3'
            )
            ->on('step1', function($request, $response, $trigger) {
                $trigger->success1 = true;

            })
            ->on('step2', function($request, $response, $trigger) {
                $trigger->success2 = true;
                return false;
            })
            ->on('step3', function($request, $response, $trigger) {
                $trigger->success3 = true;
            })
            ->export('bar2foo', true);

        $actual = $next($trigger);
        $meta = $this->object->getEventHandler()->getMeta();

        $this->assertTrue($trigger->success1);
        $this->assertTrue($trigger->success2);
        $this->assertNull($trigger->success3);
        $this->assertFalse($actual);
    }

    /**
     * @covers Cradle\Framework\App::post
     */
    public function testPost()
    {
        $instance = $this->object->post('/foo/bar', function() {});
        $this->assertInstanceOf('Cradle\Framework\App', $instance);
    }

    /**
     * @covers Cradle\Framework\App::put
     */
    public function testPut()
    {
        $instance = $this->object->put('/foo/bar', function() {});
        $this->assertInstanceOf('Cradle\Framework\App', $instance);
    }

    /**
     * @covers Cradle\Framework\App::route
     */
    public function testRoute()
    {
        $instance = $this->object->route('foobar', '/foo/bar', function() {});
        $this->assertInstanceOf('Cradle\Framework\App', $instance);

        $instance = $this->object->route('foobar', '/foo/bar', 'foobar');
        $this->assertInstanceOf('Cradle\Framework\App', $instance);

        $instance = $this->object->route('foobar', '/foo/bar', 'foobar', 'foobar2');
        $this->assertInstanceOf('Cradle\Framework\App', $instance);
    }

    /**
     * @covers Cradle\Framework\App::setParent
     */
    public function testSetParent()
    {
        $instance = $this->object->setParent(new App);
        $this->assertInstanceOf('Cradle\Framework\App', $instance);
    }

    /**
     * @covers Cradle\Framework\App::getEventHandler
     */
    public function testGetEventHandler()
    {
        $instance = $this->object->getEventHandler();
        $this->assertInstanceOf('Cradle\Event\EventHandler', $instance);
    }

    /**
     * @covers Cradle\Framework\App::on
     * @todo   Implement testOn().
     */
    public function testOn()
    {
        $trigger = new StdClass();
        $trigger->success = null;

        $callback = function() use ($trigger) {
            $trigger->success = true;
        };

        $instance = $this
            ->object
            ->on('foobar', $callback)
            ->trigger('foobar');

        $this->assertInstanceOf('Cradle\Framework\App', $instance);
        $this->assertTrue($trigger->success);
    }

    /**
     * @covers Cradle\Framework\App::setEventHandler
     * @todo   Implement testSetEventHandler().
     */
    public function testSetEventHandler()
    {
        $instance = $this->object->setEventHandler(new EventHandler);
        $this->assertInstanceOf('Cradle\Framework\App', $instance);
    }

    /**
     * @covers Cradle\Framework\App::trigger
     * @todo   Implement testTrigger().
     */
    public function testTrigger()
    {
        $trigger = new StdClass();
        $trigger->success1 = null;
        $trigger->success2 = null;
        $trigger->success3 = null;
        $trigger->success4 = null;
        $trigger->total = 0;

        $instance = $this
            ->object
            ->flow(
                'foobar',
                'step1',
                function($trigger, $foo, $bar) {
                    $foo += 1;
                    $bar += 2;
                    $trigger->success2 = true;
                    $trigger->total += $foo + $bar;
                },
                EventPipeStub::class . '::foobar',
                EventPipeStub::class . '@barfoo'
            )
            ->on('step1', function($trigger, $foo, $bar) {
                $foo += 1;
                $bar += 2;
                $trigger->success1 = true;
                $trigger->total += $foo + $bar;
            })
            ->trigger('foobar', $trigger, 1, 2);

        $this->assertInstanceOf('Cradle\Framework\App', $instance);
        $this->assertTrue($trigger->success1);
        $this->assertTrue($trigger->success2);
        $this->assertTrue($trigger->success3);
        $this->assertTrue($trigger->success4);
        $this->assertEquals(24, $trigger->total);
    }

    /**
     * @covers Cradle\Framework\App::bindCallback
     */
    public function testBindCallback()
    {
        $trigger = new StdClass;
        $trigger->success = null;
        $trigger->test = $this;

        $callback = $this->object->bindCallback(function() use ($trigger) {
            $trigger->success = true;
            $trigger->test->assertInstanceOf('Cradle\Framework\App', $this);
        });

        $callback();

        $this->assertTrue($trigger->success);
    }

    /**
     * covers Cradle\Framework\App::isPackage
     */
    public function testIsPackage()
    {
        $actual = $this->object->isPackage('foobar');
        $this->assertFalse($actual);

        $actual = $this->object->register('foobar')->isPackage('foobar');
        $this->assertTrue($actual);
    }

    /**
     * @covers Cradle\Framework\App::package
     */
    public function testPackage()
    {
        $instance = $this->object->register('foobar')->package('foobar');

        $this->assertInstanceOf('Cradle\Framework\Package', $instance);
    }

    /**
     * @covers Cradle\Framework\App::register
     */
    public function testRegister()
    {
        $instance = $this->object->register('foobar')->package('foobar');
        $this->assertInstanceOf('Cradle\Framework\Package', $instance);

        $instance = $this->object->register(function() {});
        $this->assertInstanceOf('Cradle\Framework\App', $instance);
    }

    /**
     * covers Cradle\Framework\App::setBoostrapFile
     */
    public function testSetBoostrapFile()
    {
        $instance = $this->object->setBootstrapFile('foobar');
        $this->assertInstanceOf('Cradle\Framework\App', $instance);
    }

    /**
     * @covers Cradle\Framework\App::flow
     * @todo   Implement testFlow().
     */
    public function testFlow()
    {
        $trigger = new StdClass();
        $trigger->success1 = null;
        $trigger->success2 = null;
        $trigger->success3 = null;
        $trigger->total = 0;

        $instance = $this
            ->object
            ->flow(
                'foobar',
                'step1',
                'step2',
                'step3'
            )
            ->on('step1', function($trigger, $foo, $bar) {
                $foo += 1;
                $bar += 2;
                $trigger->success1 = true;
                $trigger->total += $foo + $bar;
            })
            ->on('step2', function($trigger, $foo, $bar) {
                $foo += 1;
                $bar += 2;
                $trigger->success2 = true;
                $trigger->total += $foo + $bar;
            })
            ->on('step3', function($trigger, $foo, $bar) {
                $foo += 1;
                $bar += 2;
                $trigger->success3 = true;

                $trigger->total += $foo + $bar;
            })
            ->trigger('foobar', $trigger, 1, 2);

        $this->assertInstanceOf('Cradle\Framework\App', $instance);
        $this->assertTrue($trigger->success1);
        $this->assertTrue($trigger->success2);
        $this->assertTrue($trigger->success3);
        $this->assertEquals(18, $trigger->total);

        //advanced listeners
        $trigger = new StdClass();
        $trigger->success1 = null;
        $trigger->success2 = null;
        $trigger->success3 = null;

        $instance = $this
            ->object
            ->setEventHandler(new EventHandler)
            ->flow(
                'foo%sbar',
                'step1',
                'step2',
                'step3'
            )
            ->on('step1', function($trigger) {
                $trigger->success1 = true;
            })
            ->on('step2', function($trigger) {
                $trigger->success2 = true;
            })
            ->on('step3', function($trigger) {
                $trigger->success3 = true;
            })
            ->trigger('foozoobar', $trigger);

        $this->assertTrue($trigger->success1);
        $this->assertTrue($trigger->success2);
        $this->assertTrue($trigger->success3);

        //advanced listeners
        $trigger = new StdClass();
        $trigger->success1 = null;
        $trigger->success2 = null;
        $trigger->success3 = null;

        $instance = $this
            ->object
            ->setEventHandler(new EventHandler)
            ->flow(
                '#^foo(.+)bar$#is',
                'step1',
                'step2',
                'step3'
            )
            ->on('step1', function($trigger) {
                $trigger->success1 = true;
            })
            ->on('step2', function($trigger) {
                $trigger->success2 = true;
            })
            ->on('step3', function($trigger) {
                $trigger->success3 = true;
            })
            ->trigger('foozoobar', $trigger);

        $this->assertTrue($trigger->success1);
        $this->assertTrue($trigger->success2);
        $this->assertTrue($trigger->success3);
    }

    /**
     * @covers Cradle\Framework\App::triggerController
     */
    public function testTriggerController()
    {
        $trigger = new StdClass();
        $trigger->success4 = null;
        $trigger->total = 0;

        $instance = $this
            ->object
            ->triggerController(
                EventPipeStub::class . '@barfoo',
                $trigger,
                1,
                2
            );

        $this->assertInstanceOf('Cradle\Framework\App', $instance);
        $this->assertTrue($trigger->success4);
        $this->assertEquals(6, $trigger->total);
    }

    /**
     * @covers Cradle\Framework\App::triggerProtocol
     */
    public function testTriggerProtocol()
    {
        $trigger = new StdClass();
        $trigger->success = null;

        $this
            ->object
            ->protocol('foobar', function() use ($trigger) {
                $trigger->success = true;
            })
            ->triggerProtocol('foobar://something');

        $this->assertTrue($trigger->success);
    }
}

if(!class_exists('Cradle\Framework\EventPipeStub')) {
    class EventPipeStub
    {
        public static function foobar($trigger, $foo, $bar)
        {
            $foo += 1;
            $bar += 2;
            $trigger->success3 = true;
            $trigger->total += $foo + $bar;
        }

        public function barfoo($trigger, $foo, $bar)
        {
            $foo += 1;
            $bar += 2;
            $trigger->success4 = true;

            $trigger->total += $foo + $bar;
        }
    }
}
