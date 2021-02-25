<?php

declare(strict_types=1);

namespace ArrayOfTest\Unit\Scalars\Immutable;

use ArrayOf\ImmutableArrayOf;
use ArrayOf\Scalars\Immutable\ImmutableArrayOfInteger;
use PHPUnit\Framework\TestCase;

final class ImmutableArrayOfIntegerTest extends TestCase
{
    public function testConstruct(): void
    {
        $test = new ImmutableArrayOfInteger([1]);
        self::assertInstanceOf(ImmutableArrayOfInteger::class, $test);
        self::assertInstanceOf(ImmutableArrayOf::class, $test);
    }
}
