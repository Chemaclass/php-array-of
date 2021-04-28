<?php

declare(strict_types=1);

use TypedArrays\AbstractTypedArray;

require  dirname(__DIR__) . '/vendor/autoload.php';

interface InterfacePublication
{
    public function getPublicationName(): string;

    public function getPublicationUrl(): string;
}

final class Article implements InterfacePublication
{
    private int $id;
    private string $name;
    private string $slug;

    public function __construct(int $id, string $name, string $slug)
    {
        $this->id = $id;
        $this->name = $name;
        $this->slug = $slug;
    }

    public function getPublicationName(): string
    {
        return $this->name;
    }

    public function getPublicationUrl(): string
    {
        return "https://example.org/articles/{$this->id}-{$this->slug}";
    }
}

final class YouTubeVideo implements InterfacePublication
{
    private string $id;
    private string $name;

    public function __construct(string $id, string $name)
    {
        $this->id = $id;
        $this->name = $name;
    }

    public function getPublicationName(): string
    {
        return $this->name;
    }

    public function getPublicationUrl(): string
    {
        return "https://www.youtube.com/watch?v={$this->id}";
    }
}

final class PublicationList extends AbstractTypedArray
{
    protected function enforceType(): string
    {
        return InterfacePublication::class;
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

$publications = new PublicationList([
    new Article(1, 'TypedArrays is awesome', 'typed-arrays-is-awesome'),
    new YouTubeVideo('dQw4w9WgXcQ', 'Lil cute kittens'),
    new Article(2, 'Indeterminate graviton harmonics chain reaction', 'indeterminate-graviton-harmonics-chain-reaction'),
]);

renderPublicationList($publications);

function renderPublicationList(PublicationList $publications): void
{
    print '<ul>' . PHP_EOL;
    foreach ($publications as $publication) {
        print sprintf(
            '  <li><a href="%s">%s</a></li>' . PHP_EOL,
            $publication->getPublicationUrl(),
            $publication->getPublicationName()
        );
    }
    print '</ul>' . PHP_EOL;
}
