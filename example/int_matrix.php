<?php

declare(strict_types = 1);

use TypedArrays\AbstractTypedArray;
use TypedArrays\Scalars\ImmutableIntegerList;

require getcwd() . '/vendor/autoload.php';

final class IntMatrix extends AbstractTypedArray
{

    public static function fromArrayMatrix($input = [])
    {
        return new self(array_map(static fn ($row) => new ImmutableIntegerList($row), $input));
    }

    protected function typeToEnforce(): string
    {
        return ImmutableIntegerList::class;
    }

    protected function isMutable(): bool
    {
        return false;
    }

    protected function collectionType(): string
    {
        return self::COLLECTION_TYPE_LIST;
    }
}

$intRow1 = new ImmutableIntegerList([1, 2, 3]);
$intRow2 = new ImmutableIntegerList([4, 5, 6]);
$intRow3 = new ImmutableIntegerList([7, 8, 9]);
$intMatrix1 = new IntMatrix([$intRow1, $intRow2, $intRow3]);

var_dump($intMatrix1);

$intMatrix2 = IntMatrix::fromArrayMatrix([
    [1, 2, 3],
    [4, 5, 6],
    [7, 8, 9],
]);

var_dump($intMatrix2);
