<?php

declare(strict_types=1);

namespace ArrayOfTest\Unit\Scalars\Immutable;

use ArrayOf\Exceptions\InvalidInstantiationType;
use ArrayOf\Scalars\Immutable\ImmutableArrayOfFloat;
use ArrayOf\Traits\Immutable;
use Generator;
use PHPUnit\Framework\TestCase;
use stdClass;

final class ImmutableArrayOfFloatTest extends TestCase
{
    public function testConstruct(): void
    {
        $test = new ImmutableArrayOfFloat([1.5]);
        self::assertInstanceOf(ImmutableArrayOfFloat::class, $test);
        self::assertContains(Immutable::class, class_uses($test));
    }

    /**
     * @dataProvider providerInvalidScalarInputType
     */
    public function testInvalidScalarInputType(array $arguments): void
    {
        $this->expectException(InvalidInstantiationType::class);
        new ImmutableArrayOfFloat($arguments);
    }

    public function providerInvalidScalarInputType(): Generator
    {
        yield 'Receiving integers' => [
            'arguments' => [1, 2],
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
