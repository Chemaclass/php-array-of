<?php

declare(strict_types=1);

namespace ArrayOfTest\Unit\Scalars\Immutable;

use ArrayOf\Exceptions\InvalidInstantiationType;
use ArrayOf\Scalars\Immutable\ImmutableArrayOfBoolean;
use ArrayOf\Traits\Immutable;
use Generator;
use PHPUnit\Framework\TestCase;
use stdClass;

final class ImmutableArrayOfBooleanTest extends TestCase
{
    public function testConstruct(): void
    {
        $test = new ImmutableArrayOfBoolean([true]);
        self::assertInstanceOf(ImmutableArrayOfBoolean::class, $test);
        self::assertContains(Immutable::class, class_uses($test));
    }

    /**
     * @dataProvider providerInvalidScalarInputType
     */
    public function testInvalidScalarInputType(array $arguments): void
    {
        $this->expectException(InvalidInstantiationType::class);
        new ImmutableArrayOfBoolean($arguments);
    }

    public function providerInvalidScalarInputType(): Generator
    {
        yield 'Receiving integers' => [
            'arguments' => [1, 2],
        ];

        yield 'Receiving floats' => [
            'arguments' => [1.23, 4.56],
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
