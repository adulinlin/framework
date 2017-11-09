<?php

/**
 * This file is part of the Edoger framework.
 *
 * @author    Qingshan Luo <shanshan.lqs@gmail.com>
 * @copyright 2017 Qingshan Luo
 * @license   GNU Lesser General Public License 3.0
 */

namespace Edoger\Event;

use Edoger\Event\Contracts\Trigger as TriggerContract;
use Edoger\Event\Traits\TriggerSupport;

class Trigger extends DispatcherContainer implements TriggerContract
{
    use TriggerSupport;
}
