<?php

declare(strict_types=1);

namespace TypedArraysTest\Unit;

use PHPUnit\Framework\TestCase;
use TypedArrays\Exceptions\InvalidTypeException;
use TypedArraysTest\Unit\Fixtures\NonNullableSimpleObjectArray;
use TypedArraysTest\Unit\Fixtures\NullableSimpleObjectArray;
use TypedArraysTest\Unit\Fixtures\SimpleObject;

final class NullabilityTest extends TestCase
{
    public function test_nullability(): void
    {
        $test = new NullableSimpleObjectArray([new SimpleObject('valid'), null]);
        self::assertNull($test[1]);
    }

    public function test_nullability_of_unset(): void
    {
        $this->expectException(InvalidTypeException::class);
        new NonNullableSimpleObjectArray([new SimpleObject('invalid'), null]);
    }
}
