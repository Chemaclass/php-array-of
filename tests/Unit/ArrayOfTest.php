<?php

declare(strict_types=1);

namespace ArrayOfTest\Unit;

use ArrayOf\ArrayOf;
use ArrayOf\Exceptions\InvalidEnforcementType;
use ArrayOf\Exceptions\InvalidInstantiationType;
use ArrayOfTest\Unit\Fixtures\InvalidClassArrayOf;
use ArrayOfTest\Unit\Fixtures\InvalidScalarArrayOf;
use ArrayOfTest\Unit\Fixtures\SimpleObject;
use ArrayOfTest\Unit\Fixtures\ValidClassArrayOf;
use ArrayOfTest\Unit\Fixtures\ValidScalarArrayOf;
use PHPUnit\Framework\TestCase;
use stdClass;

final class ArrayOfTest extends TestCase
{
    public function testValidEnforcementTypes(): void
    {
        $validScalar = new ValidScalarArrayOf([]);
        self::assertInstanceOf(ArrayOf::class, $validScalar);

        $validClass = new ValidClassArrayOf([]);
        self::assertInstanceOf(ArrayOf::class, $validClass);
    }

    public function testKeysArePreserved(): void
    {
        $input = [
            'key1' => 'value1',
            'key2' => 'value2',
        ];

        $test = (array) new ValidScalarArrayOf($input);

        self::assertEquals('key1', key($test));
        next($test);
        self::assertEquals('key2', key($test));
    }

    public function testInvalidScalarEnforcementType(): void
    {
        $this->expectException(InvalidEnforcementType::class);
        new InvalidScalarArrayOf([]);
    }

    public function testInvalidClassEnforcementType(): void
    {
        $this->expectException(InvalidEnforcementType::class);
        new InvalidClassArrayOf([]);
    }

    public function testValidInputTypes(): void
    {
        $scalars = new ValidScalarArrayOf(['test', 'test-again']);
        self::assertInstanceOf(ArrayOf::class, $scalars);

        $classes = new ValidClassArrayOf([new SimpleObject(), new SimpleObject()]);
        self::assertInstanceOf(ArrayOf::class, $classes);
    }

    public function testInvalidScalarInputType(): void
    {
        $this->expectException(InvalidInstantiationType::class);
        new ValidScalarArrayOf([1]);
    }

    public function testInvalidClassInputType(): void
    {
        $this->expectException(InvalidInstantiationType::class);
        new ValidClassArrayOf([new stdClass()]);
    }

    public function testCanUseAsArray(): void
    {
        $test = new ValidScalarArrayOf(['test1', 'test2']);

        self::assertEquals('test1', $test[0]);
        self::assertEquals('test2', $test[1]);
        self::assertTrue(isset($test[0]));
        self::assertFalse(isset($test[100]));

        self::assertCount(2, $test);
    }
}
