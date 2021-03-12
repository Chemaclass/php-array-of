<?php

declare(strict_types=1);

namespace TypedArraysTest\Unit;

use PHPUnit\Framework\TestCase;
use TypedArrays\AbstractTypedArray;
use TypedArrays\Exceptions\GuardException;
use TypedArrays\Scalars\MutableStringArray;
use TypedArraysTest\Unit\Fixtures\SimpleObject;
use TypedArraysTest\Unit\Fixtures\TypedArraySimpleObjects;

final class TypedArrayTest extends TestCase
{
    public function test_valid_enforcement_types(): void
    {
        $validScalar = new MutableStringArray();
        self::assertInstanceOf(AbstractTypedArray::class, $validScalar);

        $validClass = new TypedArraySimpleObjects();
        self::assertInstanceOf(AbstractTypedArray::class, $validClass);
    }

    public function test_keys_are_preserved(): void
    {
        $input = [
            'key1' => 'value1',
            'key2' => 'value2',
        ];

        $test = (array) new MutableStringArray($input);

        self::assertSame(['key1', 'key2'], array_keys($test));
    }

    public function test_invalid_scalar_enforcement_type(): void
    {
        $this->expectExceptionObject(GuardException::invalidEnforceType('array'));

        new class() extends AbstractTypedArray {
            protected function typeToEnforce(): string
            {
                return 'array';
            }
        };
    }

    public function test_invalid_class_enforcement_type(): void
    {
        $this->expectExceptionObject(GuardException::invalidEnforceType('InvalidClassName'));

        new class([]) extends AbstractTypedArray {
            protected function typeToEnforce(): string
            {
                return 'InvalidClassName';
            }
        };
    }

    public function test_valid_input_types(): void
    {
        $scalars = new MutableStringArray(['test', 'test-again']);
        self::assertInstanceOf(AbstractTypedArray::class, $scalars);

        $classes = new TypedArraySimpleObjects([new SimpleObject(), new SimpleObject()]);
        self::assertInstanceOf(AbstractTypedArray::class, $classes);
    }

    public function test_can_use_as_array(): void
    {
        $test = new MutableStringArray(['test1', 'test2']);

        self::assertSame('test1', $test[0]);
        self::assertSame('test2', $test[1]);
        self::assertTrue(isset($test[0]));
        self::assertFalse(isset($test[100]));

        self::assertCount(2, $test);
    }
}
