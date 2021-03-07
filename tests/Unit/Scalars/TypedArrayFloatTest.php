<?php

declare(strict_types=1);

namespace TypedArraysTest\Unit\Scalars;

use Generator;
use PHPUnit\Framework\TestCase;
use stdClass;
use TypedArrays\AbstractTypedArray;
use TypedArrays\Exceptions\InvalidTypeException;
use TypedArrays\Scalars\TypedArrayFloat;

final class TypedArrayFloatTest extends TestCase
{
    public function testConstruct(): void
    {
        $test = new TypedArrayFloat([1.5]);

        self::assertInstanceOf(TypedArrayFloat::class, $test);
        self::assertInstanceOf(AbstractTypedArray::class, $test);
    }

    /**
     * @dataProvider providerInvalidScalarInputTypeOnInstantiate
     */
    public function testInvalidScalarInputTypeOnInstantiate(array $arguments): void
    {
        $this->expectException(InvalidTypeException::class);

        new TypedArrayFloat($arguments);
    }

    /**
     * @dataProvider providerInvalidScalarInputTypeOnAdd
     *
     * @param mixed $argument
     */
    public function testInvalidScalarInputTypeOnAdd($argument): void
    {
        $this->expectException(InvalidTypeException::class);

        $test = new TypedArrayFloat([]);
        $test[] = $argument;
    }

    public function providerInvalidScalarInputTypeOnInstantiate(): Generator
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

    public function providerInvalidScalarInputTypeOnAdd(): Generator
    {
        yield 'Adding integer' => [
            'argument' => 1,
        ];

        yield 'Adding boolean' => [
            'argument' => true,
        ];

        yield 'Adding stdClass' => [
            'argument' => new stdClass(),
        ];

        yield 'Adding string' => [
            'argument' => 'str1',
        ];
    }
}