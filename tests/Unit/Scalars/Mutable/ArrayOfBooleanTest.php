<?php

declare(strict_types=1);

namespace ArrayOfTest\Unit\Scalars\Mutable;

use ArrayOf\ArrayOf;
use ArrayOf\Scalars\Mutable\ArrayOfBoolean;
use PHPUnit\Framework\TestCase;

final class ArrayOfBooleanTest extends TestCase
{
    public function testConstruct(): void
    {
        $test = new ArrayOfBoolean([true]);
        self::assertInstanceOf(ArrayOfBoolean::class, $test);
        self::assertInstanceOf(ArrayOf::class, $test);
    }
}
