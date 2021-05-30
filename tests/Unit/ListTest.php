<?php

declare(strict_types=1);

namespace TypedArrays\Tests\Unit;

use PHPUnit\Framework\TestCase;
use TypedArrays\Exceptions\GuardException;
use TypedArrays\Tests\Unit\Fixtures\MutableSimpleObjectList;
use TypedArrays\Tests\Unit\Fixtures\SimpleObject;

final class ListTest extends TestCase
{
    public function test_list_constructor_throws_an_exception_when_keys_are_specified(): void
    {
        $this->expectExceptionObject(GuardException::keysNotAllowedInList());

        new MutableSimpleObjectList(['invalid' => new SimpleObject()]);
    }

    public function test_list_constructor_does_not_throw_any_exception_when_keys_are_not_specified(): void
    {
        $expected = new SimpleObject('valid');

        $test = new MutableSimpleObjectList([$expected]);

        self::assertSame($expected, $test[0]);
    }

    public function test_list_setter_throws_an_exception_when_key_is_specified(): void
    {
        $test = new MutableSimpleObjectList([new SimpleObject()]);

        $this->expectExceptionObject(GuardException::keysNotAllowedInList());

        $test['invalid'] = new SimpleObject();
    }

    public function test_list_setter_does_not_throw_any_exception_when_key_is_not_specified(): void
    {
        $test = new MutableSimpleObjectList([new SimpleObject('unmodified')]);

        $expected = new SimpleObject('modified');
        $test[] = $expected;

        self::assertSame($expected, $test[1]);
    }

    public function test_list_setter_does_not_throw_any_exception_when_an_element_is_modified_by_key(): void
    {
        $test = new MutableSimpleObjectList([new SimpleObject('unmodified')]);

        $expected = new SimpleObject('modified');
        $test[0] = $expected;

        self::assertSame($expected, $test[0]);
    }
}
