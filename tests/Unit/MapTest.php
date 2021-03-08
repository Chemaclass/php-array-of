<?php

declare(strict_types=1);

namespace TypedArraysTest\Unit;

use PHPUnit\Framework\TestCase;
use TypedArrays\Exceptions\MapException;
use TypedArraysTest\Unit\Fixtures\MutableSimpleObjectMap;
use TypedArraysTest\Unit\Fixtures\SimpleObject;

final class MapTest extends TestCase
{
    public function test_map_constructor_throws_an_exception_when_keys_are_not_specified(): void
    {
        $this->expectExceptionObject(MapException::keysRequired());

        new MutableSimpleObjectMap([new SimpleObject('invalid')]);
    }

    public function test_map_constructor_does_not_throw_any_exception_when_keys_are_specified(): void
    {
        $expected = new SimpleObject('test');
        $test = new MutableSimpleObjectMap(['valid' => $expected]);

        self::assertSame($expected, $test['valid']);
    }

    public function test_map_constructor_doest_not_throw_any_exception_when_empty_array_given(): void
    {
        $test = new MutableSimpleObjectMap([]);

        self::assertEmpty((array) $test);
    }

    public function test_map_setter_throws_an_exception_when_key_is_not_specified(): void
    {
        $test = new MutableSimpleObjectMap(['valid' => new SimpleObject()]);

        $this->expectExceptionObject(MapException::keysRequired());

        $test[] = new SimpleObject('invalid');
    }

    public function test_map_setter_does_not_throw_any_exception_when_key_is_specified(): void
    {
        $test = new MutableSimpleObjectMap(['key' => new SimpleObject()]);

        $expected = new SimpleObject('expected');
        $test['valid'] = $expected;

        self::assertSame($expected, $test['valid']);
    }
}
