<?php

declare(strict_types=1);

namespace TypedArraysTest\Unit\Scalars;

use Generator;
use PHPUnit\Framework\TestCase;
use stdClass;
use TypedArrays\AbstractTypedArray;
use TypedArrays\Exceptions\GuardException;
use TypedArrays\Exceptions\InvalidTypeException;
use TypedArrays\Scalars\ImmutableFloatArray;

final class ImmutableFloatArrayTest extends TestCase
{
    public function test_construct(): void
    {
        $test = new ImmutableFloatArray([1.5]);

        self::assertInstanceOf(ImmutableFloatArray::class, $test);
        self::assertInstanceOf(AbstractTypedArray::class, $test);
    }

    /**
     * @dataProvider providerInvalidScalarInputType
     */
    public function test_invalid_scalar_input_type(array $arguments): void
    {
        $this->expectException(InvalidTypeException::class);

        new ImmutableFloatArray($arguments);
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

    public function test_immutability_of_set(): void
    {
        $test = new ImmutableFloatArray([3.14]);

        $this->expectExceptionObject(GuardException::immutableCannotMutate());
        $test[] = 6.28;
    }

    public function test_immutability_of_unset(): void
    {
        $test = new ImmutableFloatArray([1.618]);

        $this->expectExceptionObject(GuardException::immutableCannotMutate());

        unset($test[0]);
    }
}
