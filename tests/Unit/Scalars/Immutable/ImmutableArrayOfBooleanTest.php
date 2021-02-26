<?php

declare(strict_types=1);

namespace ArrayOfTest\Unit\Scalars\Immutable;

use ArrayOf\Scalars\Immutable\ImmutableArrayOfBoolean;
use ArrayOf\Traits\Immutable;
use PHPUnit\Framework\TestCase;

final class ImmutableArrayOfBooleanTest extends TestCase
{
    public function testConstruct(): void
    {
        $test = new ImmutableArrayOfBoolean([true]);
        self::assertInstanceOf(ImmutableArrayOfBoolean::class, $test);
        self::assertContains(Immutable::class, class_uses($test));
    }
}
