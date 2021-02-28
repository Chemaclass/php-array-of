<?php

declare(strict_types=1);

namespace ArrayOfTest\Unit;

use ArrayOf\ArrayOf;
use ArrayOf\Exceptions\InvalidEnforcementType;
use ArrayOf\Scalars\Mutable\ArrayOfString;
use ArrayOfTest\Unit\Fixtures\ArrayOfSimpleObjects;
use ArrayOfTest\Unit\Fixtures\SimpleObject;
use PHPUnit\Framework\TestCase;

final class ArrayOfTest extends TestCase
{
    public function testValidEnforcementTypes(): void
    {
        $validScalar = new ArrayOfString();
        self::assertInstanceOf(ArrayOf::class, $validScalar);

        $validClass = new ArrayOfSimpleObjects();
        self::assertInstanceOf(ArrayOf::class, $validClass);
    }

    public function testKeysArePreserved(): void
    {
        $input = [
            'key1' => 'value1',
            'key2' => 'value2',
        ];

        $test = (array) new ArrayOfString($input);

        self::assertEquals(['key1', 'key2'], array_keys($test));
    }

    public function testInvalidScalarEnforcementType(): void
    {
        $this->expectException(InvalidEnforcementType::class);

        new class() extends ArrayOf {
            protected function typeToEnforce(): string
            {
                return 'array';
            }
        };
    }

    public function testInvalidClassEnforcementType(): void
    {
        $this->expectException(InvalidEnforcementType::class);

        new class([]) extends ArrayOf {
            protected function typeToEnforce(): string
            {
                return 'InvalidClassName' . md5((string) time());
            }
        };
    }

    public function testValidInputTypes(): void
    {
        $scalars = new ArrayOfString(['test', 'test-again']);
        self::assertInstanceOf(ArrayOf::class, $scalars);

        $classes = new ArrayOfSimpleObjects([new SimpleObject(), new SimpleObject()]);
        self::assertInstanceOf(ArrayOf::class, $classes);
    }

    public function testCanUseAsArray(): void
    {
        $test = new ArrayOfString(['test1', 'test2']);

        self::assertEquals('test1', $test[0]);
        self::assertEquals('test2', $test[1]);
        self::assertTrue(isset($test[0]));
        self::assertFalse(isset($test[100]));

        self::assertCount(2, $test);
    }
}
