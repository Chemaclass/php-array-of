<?php

declare(strict_types=1);

namespace ArrayOfTest\Unit\Scalars;

use ArrayOf\AbstractArrayOf;
use ArrayOf\Exceptions\InvalidTypeException;
use ArrayOf\Scalars\ArrayOfInteger;
use Generator;
use PHPUnit\Framework\TestCase;
use stdClass;

final class ArrayOfIntegerTest extends TestCase
{
    public function testConstruct(): void
    {
        $test = new ArrayOfInteger([1]);

        self::assertInstanceOf(ArrayOfInteger::class, $test);
        self::assertInstanceOf(AbstractArrayOf::class, $test);
    }

    /**
     * @dataProvider providerInvalidScalarInputTypeOnInstantiate
     */
    public function testInvalidScalarInputTypeOnInstantiate(array $arguments): void
    {
        $this->expectException(InvalidTypeException::class);

        new ArrayOfInteger($arguments);
    }

    /**
     * @dataProvider providerInvalidScalarInputTypeOnAdd
     *
     * @param mixed $argument
     */
    public function testInvalidScalarInputTypeOnAdd($argument): void
    {
        $this->expectException(InvalidTypeException::class);

        $test = new ArrayOfInteger([]);
        $test[] = $argument;
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
