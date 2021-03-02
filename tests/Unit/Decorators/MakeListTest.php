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
        $this->expectExceptionObject(ListException::keysNotAllowed());

        new MakeList(new ArrayOfString(['invalid' => 'test']));
    }

    public function testMakeListConstructorDoesNotThrowAnyExceptionWhenKeysAreNotSpecified(): void
    {
        $test = new MakeList(new ArrayOfString(['valid', 'test']));

        self::assertEquals('valid', $test[0]);
    }

    public function testMakeListSetterThrowsAnExceptionWhenKeyIsSpecified(): void
    {
        $test = new MakeList(new ArrayOfString(['test']));

        $this->expectExceptionObject(ListException::keysNotAllowed());

        $test['key'] = 'invalid';
    }

    public function testMakeListSetterDoesNotThrowAnyExceptionWhenKeyIsNotSpecified(): void
    {
        $test = new MakeList(new ArrayOfString(['test']));

        $test[] = 'valid';

        self::assertEquals('valid', $test[1]);
    }

    public function testMakeListSetterDoesNotThrowAnyExceptionWhenAnElementIsModifiedByKey(): void
    {
        $test = new MakeList(new ArrayOfString(['unmodified']));

        $test[0] = 'modified';

        self::assertEquals('modified', $test[0]);
    }
}
