<?php

/**
 * This file is part of the Edoger framework.
 *
 * @author    Qingshan Luo <shanshan.lqs@gmail.com>
 * @copyright 2017 Qingshan Luo
 * @license   GNU Lesser General Public License 3.0
 */

namespace Edoger\Event\Traits;

use Edoger\Event\Dispatcher;

trait CollectorSupport
{
    /**
     * Gets the current event dispatcher instance.
     *
     * @return Edoger\Event\Dispatcher
     */
    abstract public function getEventDispatcher(): Dispatcher;

    /**
     * Add an event listener for the specified event.
     *
     * @param  string                                   $name     The event name.
     * @param  Edoger\Event\Contracts\Listener|callable $listener The event listener.
     * @return self
     */
    public function on(string $name, $listener)
    {
        $this->getEventDispatcher()->addListener($name, $listener);

        return $this;
    }
}