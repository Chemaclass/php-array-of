<?php

declare(strict_types=1);

namespace TypedArraysTest\Unit;

use PHPUnit\Framework\TestCase;
use TypedArrays\Exceptions\MapException;
use TypedArraysTest\Unit\Fixtures\MapOfString;

final class MapTest extends TestCase
{
    public function testMapConstructorThrowsAnExceptionWhenKeysAreNotSpecified(): void
    {
        $this->expectExceptionObject(MapException::keysRequired());

        new MapOfString(['invalid']);
    }

    public function testMapConstructorDoesNotThrowAnyExceptionWhenKeysAreSpecified(): void
    {
        $test = new MapOfString(['valid' => 'test']);

        self::assertEquals('test', $test['valid']);
    }

    public function testMapSetterThrowsAnExceptionWhenKeyIsNotSpecified(): void
    {
        $test = new MapOfString(['valid' => 'test']);

        $this->expectExceptionObject(MapException::keysRequired());

        $test[] = 'invalid';
    }

    public function testMapSetterDoesNotThrowAnyExceptionWhenKeyIsSpecified(): void
    {
        $test = new MapOfString(['key' => 'test']);

        $test['valid'] = 'expected';

        self::assertEquals('expected', $test['valid']);
    }
}
