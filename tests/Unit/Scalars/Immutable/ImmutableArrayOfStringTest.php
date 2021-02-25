<?php

declare(strict_types=1);

namespace ArrayOfTest\Unit\Scalars\Immutable;

use ArrayOf\ImmutableArrayOf;
use ArrayOf\Scalars\Immutable\ImmutableArrayOfString;
use PHPUnit\Framework\TestCase;

final class ImmutableArrayOfStringTest extends TestCase
{
    public function testConstruct(): void
    {
        $test = new ImmutableArrayOfString(['test']);
        self::assertInstanceOf(ImmutableArrayOfString::class, $test);
        self::assertInstanceOf(ImmutableArrayOf::class, $test);
    }
}
