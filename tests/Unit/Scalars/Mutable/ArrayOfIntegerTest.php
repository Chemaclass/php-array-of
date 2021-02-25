<?php

declare(strict_types=1);

namespace ArrayOfTest\Unit\Scalars\Mutable;

use ArrayOf\ArrayOf;
use ArrayOf\Scalars\Mutable\ArrayOfInteger;
use PHPUnit\Framework\TestCase;

final class ArrayOfIntegerTest extends TestCase
{
    public function testConstruct(): void
    {
        $test = new ArrayOfInteger([1]);
        self::assertInstanceOf(ArrayOfInteger::class, $test);
        self::assertInstanceOf(ArrayOf::class, $test);
    }
}
