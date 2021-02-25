<?php

declare(strict_types=1);

namespace ArrayOfTest\Unit\Scalars\Mutable;

use ArrayOf\ArrayOf;
use ArrayOf\Scalars\Mutable\ArrayOfString;
use PHPUnit\Framework\TestCase;

final class ArrayOfStringTest extends TestCase
{
    public function testConstruct(): void
    {
        $test = new ArrayOfString(['test']);
        self::assertInstanceOf(ArrayOfString::class, $test);
        self::assertInstanceOf(ArrayOf::class, $test);
    }
}
