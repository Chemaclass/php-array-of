<?php

declare(strict_types=1);

namespace TypedArraysTest\Unit;

use PHPUnit\Framework\TestCase;
use TypedArrays\AbstractTypedArray;
use TypedArrays\Exceptions\InvalidSetupException;
use TypedArrays\Scalars\TypedArrayString;
use TypedArraysTest\Unit\Fixtures\SimpleObject;
use TypedArraysTest\Unit\Fixtures\TypedArraySimpleObjects;

final class TypedArrayTest extends TestCase
{
    public function testValidEnforcementTypes(): void
    {
        $validScalar = new TypedArrayString();
        self::assertInstanceOf(AbstractTypedArray::class, $validScalar);

        $validClass = new TypedArraySimpleObjects();
        self::assertInstanceOf(AbstractTypedArray::class, $validClass);
    }

    public function testKeysArePreserved(): void
    {
        $input = [
            'key1' => 'value1',
            'key2' => 'value2',
        ];

        $test = (array) new TypedArrayString($input);

        self::assertEquals(['key1', 'key2'], array_keys($test));
    }

    public function testInvalidScalarEnforcementType(): void
    {
        $this->expectException(InvalidSetupException::class);

        new class() extends AbstractTypedArray {
            protected function typeToEnforce(): string
            {
                return 'array';
            }
        };
    }

    public function testInvalidClassEnforcementType(): void
    {
        $this->expectException(InvalidSetupException::class);

        new class([]) extends AbstractTypedArray {
            protected function typeToEnforce(): string
            {
                return 'InvalidClassName' . md5((string) time());
            }
        };
    }

    public function testValidInputTypes(): void
    {
        $scalars = new TypedArrayString(['test', 'test-again']);
        self::assertInstanceOf(AbstractTypedArray::class, $scalars);

        $classes = new TypedArraySimpleObjects([new SimpleObject(), new SimpleObject()]);
        self::assertInstanceOf(AbstractTypedArray::class, $classes);
    }

    public function testCanUseAsArray(): void
    {
        $test = new TypedArrayString(['test1', 'test2']);

        self::assertEquals('test1', $test[0]);
        self::assertEquals('test2', $test[1]);
        self::assertTrue(isset($test[0]));
        self::assertFalse(isset($test[100]));

        self::assertCount(2, $test);
    }
}
