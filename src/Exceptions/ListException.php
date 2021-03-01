<?php

declare(strict_types=1);

namespace ArrayOf\Exceptions;

use Exception;

final class ListException extends Exception
{
    public function __construct()
    {
        parent::__construct('This ArrayOf object can not have keys.');
    }
}
