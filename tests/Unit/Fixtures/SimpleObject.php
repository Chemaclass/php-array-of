<?php

declare(strict_types=1);

namespace TypedArraysTest\Unit\Fixtures;

final class SimpleObject
{
    private ?string $value;

    public function __construct(string $value = null)
    {
        $this->value = $value;
    }

    public function getValue(): ?string
    {
        return $this->value;
    }
}
