<?php

declare(strict_types=1);

namespace TypedArraysTest\Unit;

use PHPUnit\Framework\TestCase;
use TypedArrays\Exceptions\GuardException;
use TypedArraysTest\Unit\Fixtures\ImmutableSimpleObjectArray;
use TypedArraysTest\Unit\Fixtures\SimpleObject;

final class ImmutabilityTest extends TestCase
{
    public function test_immutability_of_set(): void
    {
        $test = new ImmutableSimpleObjectArray([new SimpleObject()]);

        $this->expectExceptionObject(GuardException::immutableCannotMutate());

        $test[] = new SimpleObject();
    }

    public function test_immutability_of_unset(): void
    {
        $test = new ImmutableSimpleObjectArray([new SimpleObject()]);

        $this->expectExceptionObject(GuardException::immutableCannotMutate());

        unset($test[0]);
    }
}
