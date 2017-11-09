<?php

/**
 * This file is part of the Edoger framework.
 *
 * @author    Qingshan Luo <shanshan.lqs@gmail.com>
 * @copyright 2017 Qingshan Luo
 * @license   GNU Lesser General Public License 3.0
 */

namespace Edoger\Config\Tests\Support;

use Closure;
use Edoger\Config\AbstractLoader;
use Edoger\Config\Repository;

class TestLoader extends AbstractLoader
{
    protected $group;
    protected $value;

    public function __construct(string $group = 'test', array $value = [])
    {
        $this->group = $group;
        $this->value = $value;
    }

    public function load(string $group, Closure $next): Repository
    {
        if ($group === $this->group) {
            return new Repository($this->value);
        }

        return $next();
    }
}