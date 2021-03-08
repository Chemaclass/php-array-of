<?php

declare(strict_types=1);

namespace TypedArraysTest\Unit\Scalars;

use Generator;
use PHPUnit\Framework\TestCase;
use stdClass;
use TypedArrays\AbstractTypedArray;
use TypedArrays\Exceptions\InvalidTypeException;
use TypedArrays\Exceptions\MapException;
use TypedArrays\Scalars\MutableBooleanMap;

final class MutableBooleanMapTest extends TestCase
{
    public function test_construct(): void
    {
        $test = new MutableBooleanMap(['key' => true]);

        self::assertInstanceOf(MutableBooleanMap::class, $test);
        self::assertInstanceOf(AbstractTypedArray::class, $test);
    }

    /**
     * @dataProvider providerInvalidScalarInputTypeOnInstantiate
     */
    public function test_invalid_scalar_input_type_on_instantiate(array $arguments): void
    {
        $this->expectException(InvalidTypeException::class);

        new MutableBooleanMap($arguments);
    }

    /**
     * @dataProvider providerInvalidScalarInputTypeOnAdd
     *
     * @param mixed $argument
     */
    public function test_invalid_scalar_input_type_on_add($argument): void
    {
        $this->expectException(InvalidTypeException::class);

        $test = new MutableBooleanMap([]);
        $test['invalid'] = $argument;
    }

    public function providerInvalidScalarInputTypeOnInstantiate(): Generator
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

    public function providerInvalidScalarInputTypeOnAdd(): Generator
    {
        yield 'Adding integer' => [
            'argument' => 1,
        ];

        yield 'Adding float' => [
            'argument' => 1.23,
        ];

        yield 'Adding stdClass' => [
            'argument' => new stdClass(),
        ];

        yield 'Adding string' => [
            'argument' => 'str1',
        ];
    }

    public function test_map_constructor_throws_an_exception_when_keys_are_not_specified(): void
    {
        $this->expectExceptionObject(MapException::keysRequired());

        new MutableBooleanMap([false]);
    }

    public function test_map_constructor_does_not_throw_any_exception_when_keys_are_specified(): void
    {
        $test = new MutableBooleanMap(['valid' => true]);

        self::assertSame(true, $test['valid']);
    }

    public function test_map_constructor_doest_not_throw_any_exception_when_empty_array_given(): void
    {
        $test = new MutableBooleanMap([]);

        self::assertEmpty((array) $test);
    }

    public function test_map_setter_throws_an_exception_when_key_is_not_specified(): void
    {
        $test = new MutableBooleanMap(['valid' => true]);

        $this->expectExceptionObject(MapException::keysRequired());

        $test[] = false;
    }

    public function test_map_setter_does_not_throw_any_exception_when_key_is_specified(): void
    {
        $test = new MutableBooleanMap(['key' => false]);

        $test['valid'] = true;

        self::assertSame(true, $test['valid']);
    }
}
