<?php

declare(strict_types=1);

namespace TypedArraysTest\Unit\Scalars;

use Generator;
use PHPUnit\Framework\TestCase;
use stdClass;
use TypedArrays\AbstractTypedArray;
use TypedArrays\Exceptions\InvalidTypeException;
use TypedArrays\Exceptions\MapException;
use TypedArrays\Scalars\MutableFloatMap;

final class MutableFloatMapTest extends TestCase
{
    public function test_construct(): void
    {
        $test = new MutableFloatMap(['key' => 1.5]);

        self::assertInstanceOf(MutableFloatMap::class, $test);
        self::assertInstanceOf(AbstractTypedArray::class, $test);
    }

    /**
     * @dataProvider providerInvalidScalarInputTypeOnInstantiate
     */
    public function test_invalid_scalar_input_type_on_instantiate(array $arguments): void
    {
        $this->expectException(InvalidTypeException::class);

        new MutableFloatMap($arguments);
    }

    /**
     * @dataProvider providerInvalidScalarInputTypeOnAdd
     *
     * @param mixed $argument
     */
    public function test_invalid_scalar_input_type_on_add($argument): void
    {
        $this->expectException(InvalidTypeException::class);

        $test = new MutableFloatMap([]);
        $test['invalid'] = $argument;
    }

    public function providerInvalidScalarInputTypeOnInstantiate(): Generator
    {
        yield 'Receiving integers' => [
            'arguments' => ['key1' => 1, 'key2' => 2],
        ];

        yield 'Receiving booleans' => [
            'arguments' => ['key1' => true, 'key2' => false],
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

    public function test_map_constructor_throws_an_exception_when_keys_are_not_specified(): void
    {
        $this->expectExceptionObject(MapException::keysRequired());

        new MutableFloatMap([1.3]);
    }

    public function test_map_constructor_does_not_throw_any_exception_when_keys_are_specified(): void
    {
        $test = new MutableFloatMap(['valid' => 0.1]);

        self::assertSame(0.1, $test['valid']);
    }

    public function test_map_constructor_doest_not_throw_any_exception_when_empty_array_given(): void
    {
        $test = new MutableFloatMap([]);

        self::assertEmpty((array) $test);
    }

    public function test_map_setter_throws_an_exception_when_key_is_not_specified(): void
    {
        $test = new MutableFloatMap(['valid' => 4.1]);

        $this->expectExceptionObject(MapException::keysRequired());

        $test[] = 4.2;
    }

    public function test_map_setter_does_not_throw_any_exception_when_key_is_specified(): void
    {
        $test = new MutableFloatMap(['key' => 1.3]);

        $test['valid'] = 5.6;

        self::assertSame(5.6, $test['valid']);
    }
}
