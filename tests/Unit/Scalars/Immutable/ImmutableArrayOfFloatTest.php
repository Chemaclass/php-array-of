<?php

declare(strict_types=1);

namespace ArrayOfTest\Unit\Scalars\Immutable;

use ArrayOf\Scalars\Immutable\ImmutableArrayOfFloat;
use ArrayOf\Traits\Immutable;
use PHPUnit\Framework\TestCase;

final class ImmutableArrayOfFloatTest extends TestCase
{
    public function testConstruct(): void
    {
        $test = new ImmutableArrayOfFloat([1.5]);
        self::assertInstanceOf(ImmutableArrayOfFloat::class, $test);
        self::assertContains(Immutable::class, class_uses($test));
    }
}
