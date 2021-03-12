<?php

declare(strict_types=1);

namespace TypedArraysTest\Unit\Scalars;

use Generator;
use PHPUnit\Framework\TestCase;
use stdClass;
use TypedArrays\AbstractTypedArray;
use TypedArrays\Exceptions\GuardException;
use TypedArrays\Exceptions\InvalidTypeException;
use TypedArrays\Scalars\ImmutableStringArray;

final class ImmutableStringArrayTest extends TestCase
{
    public function test_construct(): void
    {
        $test = new ImmutableStringArray(['test']);

        self::assertInstanceOf(ImmutableStringArray::class, $test);
        self::assertInstanceOf(AbstractTypedArray::class, $test);
    }

    /**
     * @dataProvider providerInvalidScalarInputType
     */
    public function test_invalid_scalar_input_type(array $arguments): void
    {
        $this->expectException(InvalidTypeException::class);

        new ImmutableStringArray($arguments);
    }

    public function providerInvalidScalarInputType(): Generator
    {
        yield 'Receiving integers' => [
            'arguments' => [1, 2],
        ];

        yield 'Receiving floats' => [
            'arguments' => [1.23, 4.56],
        ];

        yield 'Receiving booleans' => [
            'arguments' => [true, false],
        ];

        yield 'Receiving stdClasses' => [
            'arguments' => [new stdClass(), new stdClass()],
        ];

        yield 'Receiving a mix of all scalars' => [
            'arguments' => [true, 1, 2.3, 'string', new stdClass()],
        ];
    }

    public function test_immutability_of_set(): void
    {
        $test = new ImmutableStringArray(['test']);

        $this->expectExceptionObject(GuardException::immutableCannotMutate());

        $test[] = 'invalid';
    }

    public function test_immutability_of_unset(): void
    {
        $test = new ImmutableStringArray(['test']);

        $this->expectExceptionObject(GuardException::immutableCannotMutate());

        unset($test[0]);
    }
}
