<?php

declare(strict_types=1);

namespace ArrayOfTest\Unit\Scalars\Mutable;

use ArrayOf\ArrayOf;
use ArrayOf\Exceptions\InvalidInstantiationType;
use ArrayOf\Scalars\Mutable\ArrayOfString;
use Generator;
use PHPUnit\Framework\TestCase;
use stdClass;

final class ArrayOfStringTest extends TestCase
{
    public function testConstruct(): void
    {
        $test = new ArrayOfString(['test']);
        self::assertInstanceOf(ArrayOfString::class, $test);
        self::assertInstanceOf(ArrayOf::class, $test);
    }

    /**
     * @dataProvider providerInvalidScalarInputType
     */
    public function testInvalidScalarInputType(array $arguments): void
    {
        $this->expectException(InvalidInstantiationType::class);
        new ArrayOfString($arguments);
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
}
