<?php

declare(strict_types=1);

namespace ArrayOfTest\Unit\Fixtures;

use ArrayOf\AbstractArrayOf;
use ArrayOf\Decorators\MakeImmutable;

final class ImmutableArrayOfSimpleObjects extends AbstractArrayOf
{
    public function __construct(array $input = [])
    {
        parent::__construct($input);
        new MakeImmutable($this);
    }

    protected function typeToEnforce(): string
    {
        return SimpleObject::class;
    }
}
