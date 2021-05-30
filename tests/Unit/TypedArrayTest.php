<?php

declare(strict_types=1);

namespace TypedArrays\Tests\Unit;

use PHPUnit\Framework\TestCase;
use TypedArrays\AbstractTypedArray;
use TypedArrays\Exceptions\GuardException;
use TypedArrays\Exceptions\InvalidTypeException;
use TypedArrays\Tests\Unit\Fixtures\SimpleObject;
use TypedArrays\Tests\Unit\Fixtures\StringArray;
use TypedArrays\Tests\Unit\Fixtures\TypedArraySimpleObjects;

final class TypedArrayTest extends TestCase
{
    public function test_valid_enforcement_types(): void
    {
        $validScalar = new StringArray();
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

        $test = (array) new StringArray($input);

        self::assertSame(['key1', 'key2'], array_keys($test));
    }

    public function test_invalid_scalar_enforcement_type(): void
    {
        $this->expectExceptionObject(GuardException::invalidEnforceType('array'));

        new class() extends AbstractTypedArray {
            protected function enforceType(): string
            {
                return 'array';
            }
        };
    }

    public function test_invalid_class_enforcement_type(): void
    {
        $this->expectExceptionObject(GuardException::invalidEnforceType('InvalidClassName'));

        new class([]) extends AbstractTypedArray {
            protected function enforceType(): string
            {
                return 'InvalidClassName';
            }
        };
    }

    public function test_invalid_class_collection_type(): void
    {
        $this->expectExceptionObject(GuardException::invalidCollectionType('InvalidCollectionType'));

        new class([]) extends AbstractTypedArray {
            protected function enforceType(): string
            {
                return self::SCALAR_STRING;
            }

            protected function collectionType(): string
            {
                return 'InvalidCollectionType';
            }
        };
    }

    public function test_valid_input_types(): void
    {
        $scalars = new StringArray(['test', 'test-again']);
        self::assertInstanceOf(AbstractTypedArray::class, $scalars);

        $classes = new TypedArraySimpleObjects([new SimpleObject(), new SimpleObject()]);
        self::assertInstanceOf(AbstractTypedArray::class, $classes);
    }

    public function test_can_use_as_array(): void
    {
        $test = new StringArray(['test1', 'test2']);

        self::assertSame('test1', $test[0]);
        self::assertSame('test2', $test[1]);
        self::assertTrue(isset($test[0]));
        self::assertFalse(isset($test[100]));

        self::assertCount(2, $test);
    }

    public function test_null_not_allow_in_array(): void
    {
        $this->expectExceptionObject(InvalidTypeException::onInstantiate(StringArray::class, 'NULL', 'string'));
        new StringArray([null, 'test2']);
    }
}
