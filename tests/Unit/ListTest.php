<?php

declare(strict_types=1);

namespace ArrayOfTest\Unit;

use ArrayOf\Exceptions\ListException;
use ArrayOfTest\Unit\Fixtures\ListOfString;
use PHPUnit\Framework\TestCase;

final class ListTest extends TestCase
{
    public function testMakeListConstructorThrowsAnExceptionWhenKeysAreSpecified(): void
    {
        $this->expectExceptionObject(ListException::keysNotAllowed());

        new ListOfString(['invalid' => 'test']);
    }

    public function testMakeListConstructorDoesNotThrowAnyExceptionWhenKeysAreNotSpecified(): void
    {
        $test = new ListOfString(['valid', 'test']);

        self::assertEquals('valid', $test[0]);
    }

    public function testMakeListSetterThrowsAnExceptionWhenKeyIsSpecified(): void
    {
        $test = new ListOfString(['test']);

        $this->expectExceptionObject(ListException::keysNotAllowed());

        $test['key'] = 'invalid';
    }

    public function testMakeListSetterDoesNotThrowAnyExceptionWhenKeyIsNotSpecified(): void
    {
        $test = new ListOfString(['test']);

        $test[] = 'valid';

        self::assertEquals('valid', $test[1]);
    }

    public function testMakeListSetterDoesNotThrowAnyExceptionWhenAnElementIsModifiedByKey(): void
    {
        $test = new ListOfString(['unmodified']);

        $test[0] = 'modified';

        self::assertEquals('modified', $test[0]);
    }
}
