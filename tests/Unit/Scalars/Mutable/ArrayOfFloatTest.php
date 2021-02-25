<?php

declare(strict_types=1);

namespace ArrayOfTest\Unit\Scalars\Mutable;

use ArrayOf\ArrayOf;
use ArrayOf\Scalars\Mutable\ArrayOfFloat;
use PHPUnit\Framework\TestCase;

final class ArrayOfFloatTest extends TestCase
{
    public function testConstruct(): void
    {
        $test = new ArrayOfFloat([1.5]);
        self::assertInstanceOf(ArrayOfFloat::class, $test);
        self::assertInstanceOf(ArrayOf::class, $test);
    }
}
