<?php

declare(strict_types=1);

namespace ArrayOfTest\Unit\Decorators;

use ArrayOf\Decorators\MakeImmutable;
use ArrayOf\Exceptions\ImmutabilityException;
use ArrayOf\Scalars\ArrayOfString;
use ArrayOfTest\Unit\Fixtures\ImmutableArrayOfSimpleObjects;
use ArrayOfTest\Unit\Fixtures\SimpleObject;
use PHPUnit\Framework\TestCase;

final class MakeImmutableTest extends TestCase
{
    public function testImmutabilityOfSetOnWrappedArrayOf(): void
    {
        $test = new MakeImmutable(new ArrayOfString(['test']));

        $this->expectException(ImmutabilityException::class);
        $this->expectExceptionMessage('This ArrayOf object is immutable.');

        $test[] = 'invalid';
    }

    public function testImmutabilityOfUnsetOnWrappedArrayOf(): void
    {
        $test = new MakeImmutable(new ArrayOfString(['test']));

        $this->expectException(ImmutabilityException::class);
        $this->expectExceptionMessage('This ArrayOf object is immutable.');

        unset($test[0]);
    }

    public function testImmutabilityOfSetOnPermanentImmutableArrayOf(): void
    {
        $test = new ImmutableArrayOfSimpleObjects([new SimpleObject()]);

        $this->expectException(ImmutabilityException::class);
        $this->expectExceptionMessage('This ArrayOf object is immutable.');

        $test[] = new SimpleObject();
    }

    public function testImmutabilityOfUnsetOnPermanentImmutableArrayOf(): void
    {
        $test = new ImmutableArrayOfSimpleObjects([new SimpleObject()]);

        $this->expectException(ImmutabilityException::class);
        $this->expectExceptionMessage('This ArrayOf object is immutable.');

        unset($test[0]);
    }
}
