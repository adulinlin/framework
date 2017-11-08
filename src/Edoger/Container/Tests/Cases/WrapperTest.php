<?php

/**
 * This file is part of the Edoger framework.
 *
 * @author    Qingshan Luo <shanshan.lqs@gmail.com>
 * @copyright 2017 Qingshan Luo
 * @license   GNU Lesser General Public License 3.0
 */

namespace Edoger\Container\Tests\Cases;

use Edoger\Container\Wrapper;
use PHPUnit\Framework\TestCase;
use stdClass;

class WrapperTest extends TestCase
{
    public function testWrapperGetSource()
    {
        $wrapper = new Wrapper('test');
        $this->assertEquals('test', $wrapper->getOriginal());

        $obj     = new stdClass();
        $hash    = spl_object_hash($obj);
        $wrapper = new Wrapper($obj);
        $this->assertEquals($obj, $wrapper->getOriginal());
        $this->assertEquals($hash, spl_object_hash($wrapper->getOriginal()));
    }
}
