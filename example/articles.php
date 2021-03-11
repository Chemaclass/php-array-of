<?php

declare(strict_types = 1);

use TypedArrays\AbstractTypedArray;

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

final class ImmutableArticleList extends AbstractTypedArray
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

function renderArticles(ImmutableArticleList $articles): void
{
    foreach ($articles as $article) {
        echo $article . PHP_EOL;
    }
}

$articles = new ImmutableArticleList([
    new Article(1, 'article-1'),
    new Article(2, 'article-2'),
]);

renderArticles($articles);

//The list is immutable, this will thrown an exception!
//$articles[] = new Article(3, 'article-3');
