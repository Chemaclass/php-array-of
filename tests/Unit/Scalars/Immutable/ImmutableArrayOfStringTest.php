<?php

declare(strict_types=1);

namespace ArrayOfTest\Unit\Scalars\Immutable;

use ArrayOf\Scalars\Immutable\ImmutableArrayOfString;
use ArrayOf\Traits\Immutable;
use PHPUnit\Framework\TestCase;

final class ImmutableArrayOfStringTest extends TestCase
{
    public function testConstruct(): void
    {
        $test = new ImmutableArrayOfString(['test']);
        self::assertInstanceOf(ImmutableArrayOfString::class, $test);
        self::assertContains(Immutable::class, class_uses($test));
    }
}
