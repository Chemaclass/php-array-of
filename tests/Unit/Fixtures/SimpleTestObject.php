<?php

declare(strict_types=1);

namespace ArrayOfTest\Unit\Fixtures;

final class SimpleTestObject
{
    private $value;

    public function __construct(?string $value = null)
    {
        $this->value = $value;
    }

    public function getValue(): ?string
    {
        return $this->value;
    }
}
