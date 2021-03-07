<?php

declare(strict_types=1);

namespace TypedArraysTest\Unit;

use PHPUnit\Framework\TestCase;
use TypedArrays\Exceptions\ImmutabilityException;
use TypedArraysTest\Unit\Fixtures\ImmutableTypedArraySimpleObjects;
use TypedArraysTest\Unit\Fixtures\SimpleObject;

final class ImmutabilityTest extends TestCase
{
    public function testImmutabilityOfSet(): void
    {
        $test = new ImmutableTypedArraySimpleObjects([new SimpleObject()]);

        $this->expectException(ImmutabilityException::class);
        $this->expectExceptionMessage('This TypedArray object is immutable.');

        $test[] = new SimpleObject();
    }

    public function testImmutabilityOfUnset(): void
    {
        $test = new ImmutableTypedArraySimpleObjects([new SimpleObject()]);

        $this->expectException(ImmutabilityException::class);
        $this->expectExceptionMessage('This TypedArray object is immutable.');

        unset($test[0]);
    }
}
