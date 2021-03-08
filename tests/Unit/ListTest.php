<?php

declare(strict_types=1);

namespace TypedArraysTest\Unit;

use PHPUnit\Framework\TestCase;
use TypedArrays\Exceptions\ListException;
use TypedArraysTest\Unit\Fixtures\MutableSimpleObjectList;
use TypedArraysTest\Unit\Fixtures\SimpleObject;

final class ListTest extends TestCase
{
    public function test_list_constructor_throws_an_exception_when_keys_are_specified(): void
    {
        $this->expectExceptionObject(ListException::keysNotAllowed());

        new MutableSimpleObjectList(['invalid' => new SimpleObject()]);
    }

    public function test_list_constructor_does_not_throw_any_exception_when_keys_are_not_specified(): void
    {
        $test = new MutableSimpleObjectList([new SimpleObject('valid')]);

        self::assertEquals(new SimpleObject('valid'), $test[0]);
    }

    public function test_list_setter_throws_an_exception_when_key_is_specified(): void
    {
        $test = new MutableSimpleObjectList([new SimpleObject()]);

        $this->expectExceptionObject(ListException::keysNotAllowed());

        $test['invalid'] = new SimpleObject();
    }

    public function test_list_setter_does_not_throw_any_exception_when_key_is_not_specified(): void
    {
        $test = new MutableSimpleObjectList([new SimpleObject()]);

        $test[] = new SimpleObject('valid');

        self::assertEquals(new SimpleObject('valid'), $test[1]);
    }

    public function test_list_setter_does_not_throw_any_exception_when_an_element_is_modified_by_key(): void
    {
        $test = new MutableSimpleObjectList([new SimpleObject('unmodified')]);

        $test[0] = new SimpleObject('modified');

        self::assertEquals(new SimpleObject('modified'), $test[0]);
    }
}
