<?php

declare(strict_types=1);

namespace ArrayOfTest\Unit\Traits;

use ArrayOf\Exceptions\ImmutabilityException;
use ArrayOfTest\Unit\Fixtures\ValidScalarImmutableArrayOf;
use PHPUnit\Framework\TestCase;

final class ImmutableTest extends TestCase
{
    public function testImmutabilityOfSet(): void
    {
        $test = new ValidScalarImmutableArrayOf(['test']);
        $this->expectException(ImmutabilityException::class);
        $this->expectExceptionMessage('ArrayOfTest\Unit\Fixtures\ValidScalarImmutableArrayOf objects are immutable.');
        $test[] = 'invalid';
    }

    public function testImmutabilityOfUnset(): void
    {
        $test = new ValidScalarImmutableArrayOf(['test']);
        $this->expectException(ImmutabilityException::class);
        $this->expectExceptionMessage('ArrayOfTest\Unit\Fixtures\ValidScalarImmutableArrayOf objects are immutable.');
        unset($test[0]);
    }
}
