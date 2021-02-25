<?php

declare(strict_types=1);

namespace ArrayOfTest\Unit\Scalars\Immutable;

use ArrayOf\Scalars\Immutable\ImmutableArrayOfInteger;
use ArrayOf\Traits\Immutable;
use PHPUnit\Framework\TestCase;

final class ImmutableArrayOfIntegerTest extends TestCase
{
    public function testConstruct(): void
    {
        $test = new ImmutableArrayOfInteger([1]);
        self::assertInstanceOf(ImmutableArrayOfInteger::class, $test);
        self::assertContains(Immutable::class, class_uses($test));
    }
}
