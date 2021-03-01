<?php

declare(strict_types=1);

namespace ArrayOfTest\Unit\Scalars\Mutable;

use ArrayOf\AbstractArrayOf;
use ArrayOf\Exceptions\InvalidInstantiationType;
use ArrayOf\Scalars\Mutable\ArrayOfInteger;
use Generator;
use PHPUnit\Framework\TestCase;
use stdClass;

final class ArrayOfIntegerTest extends TestCase
{
    public function testConstruct(): void
    {
        $test = new ArrayOfInteger([1]);
        self::assertInstanceOf(ArrayOfInteger::class, $test);
        self::assertInstanceOf(AbstractArrayOf::class, $test);
    }

    /**
     * @dataProvider providerInvalidScalarInputType
     */
    public function testInvalidScalarInputType(array $arguments): void
    {
        $this->expectException(InvalidInstantiationType::class);
        new ArrayOfInteger($arguments);
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
