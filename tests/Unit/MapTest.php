<?php

declare(strict_types=1);

namespace TypedArraysTest\Unit;

use PHPUnit\Framework\TestCase;
use TypedArrays\Exceptions\MapException;
use TypedArraysTest\Unit\Fixtures\MapOfString;

final class MapTest extends TestCase
{
    public function test_map_constructor_throws_an_exception_when_keys_are_not_specified(): void
    {
        $this->expectExceptionObject(MapException::keysRequired());

        new MapOfString(['invalid']);
    }

    public function test_map_constructor_does_not_throw_any_exception_when_keys_are_specified(): void
    {
        $test = new MapOfString(['valid' => 'test']);

        self::assertSame('test', $test['valid']);
    }

    public function test_map_setter_throws_an_exception_when_key_is_not_specified(): void
    {
        $test = new MapOfString(['valid' => 'test']);

        $this->expectExceptionObject(MapException::keysRequired());

        $test[] = 'invalid';
    }

    public function test_map_setter_does_not_throw_any_exception_when_key_is_specified(): void
    {
        $test = new MapOfString(['key' => 'test']);

        $test['valid'] = 'expected';

        self::assertSame('expected', $test['valid']);
    }
}
