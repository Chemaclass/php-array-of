<?php

declare(strict_types=1);

namespace ArrayOfTest\Unit\Traits;

use ArrayOf\Decorators\MakeImmutable;
use ArrayOf\Exceptions\ImmutabilityException;
use ArrayOf\Scalars\ArrayOfString;
use PHPUnit\Framework\TestCase;

final class MakeImmutableTest extends TestCase
{
    public function testImmutabilityOfSet(): void
    {
        $test = new MakeImmutable(new ArrayOfString(['test']));
        $this->expectException(ImmutabilityException::class);
        $this->expectExceptionMessage('This ArrayOf object is immutable.');
        $test[] = 'invalid';
    }

    public function testImmutabilityOfUnset(): void
    {
        $test = new MakeImmutable(new ArrayOfString(['test']));
        $this->expectException(ImmutabilityException::class);
        $this->expectExceptionMessage('This ArrayOf object is immutable.');
        unset($test[0]);
    }
}
