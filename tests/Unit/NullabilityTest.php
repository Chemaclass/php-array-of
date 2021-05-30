<?php

declare(strict_types=1);

namespace TypedArrays\Tests\Unit;

use PHPUnit\Framework\TestCase;
use TypedArrays\Exceptions\InvalidTypeException;
use TypedArrays\Tests\Unit\Fixtures\NonNullableSimpleObjectArray;
use TypedArrays\Tests\Unit\Fixtures\NullableSimpleObjectArray;
use TypedArrays\Tests\Unit\Fixtures\SimpleObject;

final class NullabilityTest extends TestCase
{
    public function test_array_allows_null(): void
    {
        $test = new NullableSimpleObjectArray([new SimpleObject('valid'), null]);
        self::assertNull($test[1]);
    }

    public function test_array_no_allows_null(): void
    {
        $this->expectException(InvalidTypeException::class);
        new NonNullableSimpleObjectArray([new SimpleObject('invalid'), null]);
    }

    public function test_set_null(): void
    {
        $test = new NullableSimpleObjectArray([]);
        $test[] = null;

        self::assertNull($test[0]);
    }

    public function test_unset_null(): void
    {
        $test = new NullableSimpleObjectArray([null]);
        unset($test[0]);

        self::assertEmpty($test);
    }
}
