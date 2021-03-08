<?php

declare(strict_types=1);

namespace TypedArraysTest\Unit;

use PHPUnit\Framework\TestCase;
use TypedArrays\Exceptions\ListException;
use TypedArraysTest\Unit\Fixtures\ListOfString;

final class ListTest extends TestCase
{
    public function test_list_constructor_throws_an_exception_when_keys_are_specified(): void
    {
        $this->expectExceptionObject(ListException::keysNotAllowed());

        new ListOfString(['invalid' => 'test']);
    }

    public function test_list_constructor_does_not_throw_any_exception_when_keys_are_not_specified(): void
    {
        $test = new ListOfString(['valid', 'test']);

        self::assertEquals('valid', $test[0]);
    }

    public function test_list_setter_throws_an_exception_when_key_is_specified(): void
    {
        $test = new ListOfString(['test']);

        $this->expectExceptionObject(ListException::keysNotAllowed());

        $test['key'] = 'invalid';
    }

    public function test_list_setter_does_not_throw_any_exception_when_key_is_not_specified(): void
    {
        $test = new ListOfString(['test']);

        $test[] = 'valid';

        self::assertEquals('valid', $test[1]);
    }

    public function test_list_setter_does_not_throw_any_exception_when_an_element_is_modified_by_key(): void
    {
        $test = new ListOfString(['unmodified']);

        $test[0] = 'modified';

        self::assertEquals('modified', $test[0]);
    }
}
