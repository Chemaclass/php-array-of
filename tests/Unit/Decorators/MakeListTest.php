<?php

declare(strict_types=1);

namespace ArrayOfTest\Unit\Decorators;

use ArrayOf\Decorators\MakeList;
use ArrayOf\Exceptions\ListException;
use ArrayOf\Scalars\ArrayOfString;
use PHPUnit\Framework\TestCase;

final class MakeListTest extends TestCase
{
    public function testMakeListConstructorThrowsAnExceptionWhenKeysAreSpecified(): void
    {
        $this->expectException(ListException::class);
        $this->expectExceptionMessage('This ArrayOf object can not have keys.');

        new MakeList(new ArrayOfString(['invalid' => 'test']));
    }

    public function testMakeListConstructorDoesNotThrowAnyExceptionWhenKeysAreNotSpecified(): void
    {
        $test = new MakeList(new ArrayOfString(['valid', 'test']));

        $this->assertEquals('valid', $test[0]);
    }

    public function testMakeListSetterThrowsAnExceptionWhenKeyIsSpecified(): void
    {
        $test = new MakeList(new ArrayOfString(['test']));

        $this->expectException(ListException::class);
        $this->expectExceptionMessage('This ArrayOf object can not have keys.');

        $test['key'] = 'invalid';
    }

    public function testMakeListSetterDoesNotThrowAnyExceptionWhenKeyIsNotSpecified(): void
    {
        $test = new MakeList(new ArrayOfString(['test']));

        $test[] = 'valid';

        $this->assertEquals('valid', $test[1]);
    }

    public function testMakeListSetterDoesNotThrowAnyExceptionWhenAnElementIsModifiedByKey(): void
    {
        $test = new MakeList(new ArrayOfString(['unmodified']));

        $test[0] = 'modified';

        $this->assertEquals('modified', $test[0]);
    }
}
