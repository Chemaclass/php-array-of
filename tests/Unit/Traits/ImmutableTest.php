<?php

declare(strict_types=1);

namespace ArrayOfTest\Unit\Traits;

use ArrayOf\Exceptions\ImmutabilityException;
use ArrayOf\Scalars\Immutable\ImmutableArrayOfString;
use PHPUnit\Framework\TestCase;

final class ImmutableTest extends TestCase
{
    public function testImmutabilityOfSet(): void
    {
        $test = new ImmutableArrayOfString(['test']);
        $this->expectException(ImmutabilityException::class);
        $this->expectExceptionMessage('ImmutableArrayOfString objects are immutable.');
        $test[] = 'invalid';
    }

    public function testImmutabilityOfUnset(): void
    {
        $test = new ImmutableArrayOfString(['test']);
        $this->expectException(ImmutabilityException::class);
        $this->expectExceptionMessage('ImmutableArrayOfString objects are immutable.');
        unset($test[0]);
    }
}
