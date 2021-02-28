<?php

declare(strict_types=1);

namespace ArrayOfTest\Unit\Scalars\Immutable;

use ArrayOf\Exceptions\InvalidInstantiationType;
use ArrayOf\Scalars\Immutable\ImmutableArrayOfInteger;
use ArrayOf\Traits\Immutable;
use Generator;
use PHPUnit\Framework\TestCase;
use stdClass;

final class ImmutableArrayOfIntegerTest extends TestCase
{
    public function testConstruct(): void
    {
        $test = new ImmutableArrayOfInteger([1]);
        self::assertInstanceOf(ImmutableArrayOfInteger::class, $test);
        self::assertContains(Immutable::class, class_uses($test));
    }

    /**
     * @dataProvider providerInvalidScalarInputType
     */
    public function testInvalidScalarInputType(array $arguments): void
    {
        $this->expectException(InvalidInstantiationType::class);
        new ImmutableArrayOfInteger($arguments);
    }

    public function providerInvalidScalarInputType(): Generator
    {
        yield 'Receiving floats' => [
            'arguments' => [1.23, 4.56],
        ];

        yield 'Receiving booleans' => [
            'arguments' => [true, false],
        ];

        yield 'Receiving stdClasses' => [
            'arguments' => [new stdClass(), new stdClass()],
        ];

        yield 'Receiving strings' => [
            'arguments' => ['str1', 'str2'],
        ];

        yield 'Receiving a mix of all scalars' => [
            'arguments' => [true, 1, 2.3, 'string', new stdClass()],
        ];
    }
}
