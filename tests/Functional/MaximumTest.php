<?php

/**
 * @package   Functional-php
 * @author    Lars Strojny <lstrojny@php.net>
 * @copyright 2011-2021 Lars Strojny
 * @license   https://opensource.org/licenses/MIT MIT
 * @link      https://github.com/lstrojny/functional-php
 */

namespace Functional\Tests;

use ArrayIterator;
use stdClass;

use function Functional\maximum;

class MaximumTest extends AbstractTestCase
{
    protected function setUp(): void
    {
        parent::setUp();
        $this->list = [1, "foo", 5.1, 5, "5.2", true, false, [], new stdClass()];
        $this->listIterator = new ArrayIterator($this->list);
        $this->hash = [
            'k1' => 1,
            'k2' => '5.2',
            'k3' => 5,
            'k4' => '5.1',
            'k5' => 10.2,
            'k6' => true,
            'k7' => [],
            'k8' => new stdClass(),
        ];
        $this->hashIterator = new ArrayIterator($this->hash);
    }

    public function testExtractingMaximumValue(): void
    {
        self::assertEquals('5.2', maximum($this->list));
        self::assertEquals('5.2', maximum($this->listIterator));
        self::assertEquals(10.2, maximum($this->hash));
        self::assertEquals(10.2, maximum($this->hashIterator));
    }

    public function testSpecialCaseNull(): void
    {
        self::assertSame(-1, maximum([-1]));
    }

    public function testSpecialCaseSameValueDifferentTypes(): void
    {
        self::assertSame(1, maximum([0, 1, 0.0, 1.0, "0", "1", "0.0", "1.0"]));
    }

    public function testPassNoCollection(): void
    {
        $this->expectArgumentError('Functional\maximum() expects parameter 1 to be array or instance of Traversable');
        maximum('invalidCollection');
    }
}
