<?php

declare(strict_types=1);

namespace TypedArrays\Tests\Unit\Fixtures;

final class SimpleObject
{
    private string $value;

    public function __construct(string $value = '')
    {
        $this->value = $value;
    }

    public function getValue(): string
    {
        return $this->value;
    }
}
