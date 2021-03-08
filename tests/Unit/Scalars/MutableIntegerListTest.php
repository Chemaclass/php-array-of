<?php

declare(strict_types=1);

namespace TypedArraysTest\Unit\Scalars;

use Generator;
use PHPUnit\Framework\TestCase;
use stdClass;
use TypedArrays\AbstractTypedArray;
use TypedArrays\Exceptions\InvalidTypeException;
use TypedArrays\Exceptions\ListException;
use TypedArrays\Scalars\MutableIntegerList;

final class MutableIntegerListTest extends TestCase
{
    public function test_construct(): void
    {
        $test = new MutableIntegerList([1]);

        self::assertInstanceOf(MutableIntegerList::class, $test);
        self::assertInstanceOf(AbstractTypedArray::class, $test);
    }

    /**
     * @dataProvider providerInvalidScalarInputTypeOnInstantiate
     */
    public function test_invalid_scalar_input_type_on_instantiate(array $arguments): void
    {
        $this->expectException(InvalidTypeException::class);

        new MutableIntegerList($arguments);
    }

    /**
     * @dataProvider providerInvalidScalarInputTypeOnAdd
     *
     * @param mixed $argument
     */
    public function test_invalid_scalar_input_type_on_add($argument): void
    {
        $this->expectException(InvalidTypeException::class);

        $test = new MutableIntegerList([]);
        $test[] = $argument;
    }

    public function test_list_constructor_throws_an_exception_when_keys_are_specified(): void
    {
        $this->expectExceptionObject(ListException::keysNotAllowed());

        new MutableIntegerList(['invalid' => 1]);
    }

    public function test_list_constructor_does_not_throw_any_exception_when_keys_are_not_specified(): void
    {
        $test = new MutableIntegerList([2]);

        self::assertSame(2, $test[0]);
    }

    public function test_list_setter_throws_an_exception_when_key_is_specified(): void
    {
        $test = new MutableIntegerList([3]);

        $this->expectExceptionObject(ListException::keysNotAllowed());

        $test['invalid'] = 5;
    }

    public function test_list_setter_does_not_throw_any_exception_when_key_is_not_specified(): void
    {
        $test = new MutableIntegerList([8]);

        $test[] = 13;

        self::assertSame(13, $test[1]);
    }

    public function test_list_setter_does_not_throw_any_exception_when_an_element_is_modified_by_key(): void
    {
        $test = new MutableIntegerList([21]);

        $test[0] = 34;

        self::assertSame(34, $test[0]);
    }

    public function providerInvalidScalarInputTypeOnInstantiate(): Generator
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

    public function providerInvalidScalarInputTypeOnAdd(): Generator
    {
        yield 'Adding float' => [
            'argument' => 1.23,
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
