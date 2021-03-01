<?php

declare(strict_types=1);

namespace ArrayOfTest\Unit\Scalars;

use ArrayOf\AbstractArrayOf;
use ArrayOf\Exceptions\InvalidInstantiationType;
use ArrayOf\Scalars\ArrayOfFloat;
use Generator;
use PHPUnit\Framework\TestCase;
use stdClass;

final class ArrayOfFloatTest extends TestCase
{
    public function testConstruct(): void
    {
        $test = new ArrayOfFloat([1.5]);
        self::assertInstanceOf(ArrayOfFloat::class, $test);
        self::assertInstanceOf(AbstractArrayOf::class, $test);
    }

    /**
     * @dataProvider providerInvalidScalarInputType
     */
    public function testInvalidScalarInputType(array $arguments): void
    {
        $this->expectException(InvalidInstantiationType::class);
        new ArrayOfFloat($arguments);
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
