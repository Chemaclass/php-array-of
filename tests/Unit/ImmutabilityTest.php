<?php

declare(strict_types=1);

namespace ArrayOfTest\Unit;

use ArrayOf\Exceptions\ImmutabilityException;
use ArrayOfTest\Unit\Fixtures\ImmutableArrayOfSimpleObjects;
use ArrayOfTest\Unit\Fixtures\SimpleObject;
use PHPUnit\Framework\TestCase;

final class ImmutabilityTest extends TestCase
{
    public function testImmutabilityOfSet(): void
    {
        $test = new ImmutableArrayOfSimpleObjects([new SimpleObject()]);

        $this->expectException(ImmutabilityException::class);
        $this->expectExceptionMessage('This ArrayOf object is immutable.');

        $test[] = new SimpleObject();
    }

    public function testImmutabilityOfUnset(): void
    {
        $test = new ImmutableArrayOfSimpleObjects([new SimpleObject()]);

        $this->expectException(ImmutabilityException::class);
        $this->expectExceptionMessage('This ArrayOf object is immutable.');

        unset($test[0]);
    }
}
