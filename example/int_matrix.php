<?php

declare(strict_types=1);

use TypedArrays\AbstractTypedArray;
use TypedArrays\Exceptions\InvalidSetupException;
use TypedArrays\Exceptions\InvalidTypeException;
use TypedArrays\Exceptions\ListException;
use TypedArrays\Exceptions\MapException;
use TypedArrays\Scalars\ImmutableIntegerList;

require getcwd() . '/vendor/autoload.php';

final class IntMatrix extends AbstractTypedArray
{
    /**
     * @throws InvalidSetupException
     * @throws InvalidTypeException
     * @throws ListException
     * @throws MapException
     */
    public static function fromArrayMatrix(array $input = []): self
    {
        return new self(array_map(
            static fn (array $row) => new ImmutableIntegerList($row),
            $input
        ));
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

// Example 1: using the normal constructor
$intRow1 = new ImmutableIntegerList([1, 2, 3]);
$intRow2 = new ImmutableIntegerList([4, 5, 6]);
$intRow3 = new ImmutableIntegerList([7, 8, 9]);
$intMatrix1 = new IntMatrix([$intRow1, $intRow2, $intRow3]);

print 'Matrix 1' . PHP_EOL;
printMatrix($intMatrix1);

// Example 1: using the named constructor
$intMatrix2 = IntMatrix::fromArrayMatrix([
    [1, 2, 3],
    [4, 5, 6],
    [7, 8, 9],
]);

print 'Matrix 2' . PHP_EOL;
printMatrix($intMatrix2);

function printMatrix(IntMatrix $matrix): void
{
    foreach ($matrix as $row) {
        foreach ($row as $column => $value) {
            print $value . ' ';
        }
        print PHP_EOL;
    }
}
