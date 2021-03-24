<?php

declare(strict_types=1);

use TypedArrays\AbstractTypedArray;

require  dirname(__DIR__) . '/vendor/autoload.php';

final class MutableTranslationMap extends AbstractTypedArray
{
    protected function typeToEnforce(): string
    {
        return self::SCALAR_STRING;
    }

    protected function collectionType(): string
    {
        return self::COLLECTION_TYPE_MAP;
    }

    protected function isNullAllowed(): bool
    {
        return true;
    }
}

function renderTranslations(MutableTranslationMap $translations, string $fallback = 'en'): void
{
    foreach ($translations as $language => $word) {
        $translated = $word ?? $translations[$fallback];
        echo "{$language} => {$translated}" . PHP_EOL;
    }
}

$translations = new MutableTranslationMap([
    'en' => 'hello',
    'es' => 'hola',
    'fr' => null,
]);

renderTranslations($translations);

$translations['fr'] = 'salut';
$translations['de'] = 'hallo';

echo '***********' . PHP_EOL;
renderTranslations($translations);
