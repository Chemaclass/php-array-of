<?php

declare(strict_types = 1);

use ArrayOf\AbstractArrayOf;
use ArrayOf\Decorators\MakeImmutable;

require getcwd() . '/vendor/autoload.php';

final class Article
{
    private int $id;
    private string $name;

    public function __construct(int $id, string $name)
    {
        $this->id = $id;
        $this->name = $name;
    }

    public function id(): int
    {
        return $this->id;
    }

    public function name(): string
    {
        return $this->name;
    }

    public function __toString(): string
    {
        return "Article {id: $this->id, name: '$this->name'}";
    }
}

final class ArrayOfArticles extends AbstractArrayOf
{
    protected function typeToEnforce(): string
    {
        return Article::class;
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

function renderArticles(ArrayOfArticles $articles): void
{
    foreach ($articles as $article) {
        echo $article . PHP_EOL;
    }
}

$articles = new ArrayOfArticles([
    new Article(1, 'article-1'),
    new Article(2, 'article-2'),
]);

renderArticles($articles);
