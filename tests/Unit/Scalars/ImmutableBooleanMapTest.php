<?php

declare(strict_types=1);

namespace TypedArraysTest\Unit\Scalars;

use Generator;
use PHPUnit\Framework\TestCase;
use stdClass;
use TypedArrays\AbstractTypedArray;
use TypedArrays\Exceptions\GuardException;
use TypedArrays\Exceptions\InvalidTypeException;
use TypedArrays\Scalars\ImmutableBooleanMap;

final class ImmutableBooleanMapTest extends TestCase
{
    public function test_construct(): void
    {
        $test = new ImmutableBooleanMap(['key' => true]);

        self::assertInstanceOf(ImmutableBooleanMap::class, $test);
        self::assertInstanceOf(AbstractTypedArray::class, $test);
    }

    /**
     * @dataProvider providerInvalidScalarInputType
     */
    public function test_invalid_scalar_input_type(array $arguments): void
    {
        $this->expectException(InvalidTypeException::class);

        new ImmutableBooleanMap($arguments);
    }

    public function providerInvalidScalarInputType(): Generator
    {
        yield 'Receiving integers' => [
            'arguments' => ['key1' => 1, 'key2' => 2],
        ];

        yield 'Receiving floats' => [
            'arguments' => ['key1' => 1.23, 'key2' => 4.56],
        ];

        yield 'Receiving stdClasses' => [
            'arguments' => ['key1' => new stdClass(), 'key2' => new stdClass()],
        ];

        yield 'Receiving strings' => [
            'arguments' => ['key1' => 'str1', 'key2' => 'str2'],
        ];

        yield 'Receiving a mix of all scalars' => [
            'arguments' => ['key1' => true, 'key2' => 1, 'key3' => 2.3, 'key4' => 'string', 'key5' => new stdClass()],
        ];
    }

    public function test_immutability_of_set(): void
    {
        $test = new ImmutableBooleanMap(['key' => true]);

        $this->expectExceptionObject(GuardException::immutableCannotMutate());

        $test['invalid'] = false;
    }

    public function test_immutability_of_unset(): void
    {
        $test = new ImmutableBooleanMap(['key' => false]);

        $this->expectExceptionObject(GuardException::immutableCannotMutate());

        unset($test['key']);
    }

    public function test_map_constructor_throws_an_exception_when_keys_are_not_specified(): void
    {
        $this->expectExceptionObject(GuardException::keysRequiredInMap());

        new ImmutableBooleanMap([false]);
    }

    public function test_map_constructor_does_not_throw_any_exception_when_keys_are_specified(): void
    {
        $test = new ImmutableBooleanMap(['valid' => true]);

        self::assertTrue($test['valid']);
    }

    public function test_map_constructor_doest_not_throw_any_exception_when_empty_array_given(): void
    {
        $test = new ImmutableBooleanMap([]);

        self::assertEmpty((array) $test);
    }
}
