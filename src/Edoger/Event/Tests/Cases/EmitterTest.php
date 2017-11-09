<?php

/**
 * This file is part of the Edoger framework.
 *
 * @author    Qingshan Luo <shanshan.lqs@gmail.com>
 * @copyright 2017 Qingshan Luo
 * @license   GNU Lesser General Public License 3.0
 */

namespace Edoger\Event\Tests\Cases;

use Edoger\Event\Contracts\Collector;
use Edoger\Event\Contracts\Trigger;
use Edoger\Event\Dispatcher;
use Edoger\Event\DispatcherContainer;
use Edoger\Event\Emitter;
use Edoger\Event\Event;
use Edoger\Event\Tests\Support\TestListener;
use Edoger\Event\Traits\CollectorSupport;
use Edoger\Event\Traits\TriggerSupport;
use PHPUnit\Framework\TestCase;

class EmitterTest extends TestCase
{
    protected $dispatcher;
    protected $emitter;

    protected function setUp()
    {
        $this->dispatcher = new Dispatcher([], 'group');
        $this->emitter    = new Emitter($this->dispatcher);
    }

    protected function tearDown()
    {
        $this->dispatcher = null;
        $this->emitter    = null;
    }

    public function testEmitterUseTraitCollectorSupport()
    {
        $dispatcher = new Dispatcher();
        $emitter    = new Emitter($dispatcher);
        $uses       = class_uses($emitter);

        $this->assertArrayHasKey(CollectorSupport::class, $uses);
        $this->assertEquals(CollectorSupport::class, $uses[CollectorSupport::class]);
    }

    public function testEmitterUseTraitTriggerSupport()
    {
        $dispatcher = new Dispatcher();
        $emitter    = new Emitter($dispatcher);
        $uses       = class_uses($emitter);

        $this->assertArrayHasKey(TriggerSupport::class, $uses);
        $this->assertEquals(TriggerSupport::class, $uses[TriggerSupport::class]);
    }

    public function testEmitterExtendsDispatcherContainer()
    {
        $dispatcher = new Dispatcher();
        $emitter    = new Emitter($dispatcher);

        $this->assertInstanceOf(DispatcherContainer::class, $emitter);
    }

    public function testEmitterInstanceOfCollector()
    {
        $dispatcher = new Dispatcher();
        $emitter    = new Emitter($dispatcher);

        $this->assertInstanceOf(Collector::class, $emitter);
    }

    public function testEmitterInstanceOfTrigger()
    {
        $dispatcher = new Dispatcher();
        $emitter    = new Emitter($dispatcher);

        $this->assertInstanceOf(Trigger::class, $emitter);
    }

    public function testEmitterGetEventDispatcher()
    {
        $dispatcher = new Dispatcher();
        $emitter    = new Emitter($dispatcher);

        $this->assertInstanceOf(Dispatcher::class, $emitter->getEventDispatcher());
        $this->assertEquals($dispatcher, $emitter->getEventDispatcher());
    }

    public function testEmitterOn()
    {
        $listener   = new TestListener();
        $dispatcher = new Dispatcher();
        $emitter    = new Emitter($dispatcher);

        $this->assertEquals($emitter, $emitter->on('test', $listener));
        $this->assertEquals([$listener], $dispatcher->getListeners('test'));
    }

    public function testEmitterHasEventListener()
    {
        $listener   = new TestListener();
        $dispatcher = new Dispatcher();
        $emitter    = new Emitter($dispatcher);

        $this->assertFalse($emitter->hasEventListener('test'));

        $dispatcher->addListener('test', $listener);

        $this->assertTrue($emitter->hasEventListener('test'));
    }

    public function testEmitterEmit()
    {
        $this->expectOutputString('TestListener');

        $listener   = new TestListener('TestListener');
        $dispatcher = new Dispatcher();
        $emitter    = new Emitter($dispatcher);

        $emitter->on('test', $listener);

        $this->assertInstanceOf(Event::class, $emitter->emit('test'));
    }
}