<p align="center">
  <a href="https://github.com/chemaclass/typed-arrays/actions">
    <img src="https://github.com/chemaclass/typed-arrays/workflows/CI/badge.svg" alt="GitHub Build Status">
  </a>
  <a href="https://scrutinizer-ci.com/g/chemaclass/typed-arrays/?branch=master">
    <img src="https://scrutinizer-ci.com/g/chemaclass/typed-arrays/badges/quality-score.png?b=master" alt="Scrutinizer Code Quality">
  </a>
  <a href="https://scrutinizer-ci.com/g/chemaclass/typed-arrays/?branch=master">
    <img src="https://scrutinizer-ci.com/g/chemaclass/typed-arrays/badges/coverage.png?b=master" alt="Scrutinizer Code Coverage">
  </a>
  <a href="https://shepherd.dev/github/chemaclass/typed-arrays">
    <img src="https://shepherd.dev/github/chemaclass/typed-arrays/coverage.svg" alt="Psalm Type-coverage Status">
  </a>
</p>

# TypedArrays

Generics replacement for PHP. 
Implement an array of a defined type.

## Why? 

Because we believe there is a difference between a List and a Map.
Map is a mapping of key/values, a list of a list of items.
There are several benefits when guaranteeing that all the elements from an array are of a known type as type-safe and ease of reading.

## Requirements

Requires PHP >= 7.4

## Installation

```
composer require chemaclass/typed-arrays
```

## How does this library work?

This is an example of a class you would create in order to implement collections of a specific class.
```php
final class ImmutableObjectList extends TypedArrays\AbstractTypedArray
{
    protected function typeToEnforce(): string
    {
        return Object::class;
    }

    protected function collectionType(): string
    {
        return self::COLLECTION_TYPE_LIST;
    }

    protected function isMutable(): bool
    {
        return false;
    }

    protected function isNullAllowed(): bool
    {
        return true;
    }
}
```

## Type to Enforce

You must implement this method. Here you define what kind of object this collection will handle:
```php
protected function typeToEnforce(): string
{
    return Object::class;
}
```

## Collection Types

There are different kinds of collections.
In this library you can find up to three different types: `array`, `map` and `list`.

By default, the collections are array, but you can specify the collection type by overriding this function in your domain:
```php
protected function collectionType(): string
{
    return self::COLLECTION_TYPE_ARRAY;
}
```

### Array

`const COLLECTION_TYPE_ARRAY = 'array'`

- Similar as native PHP arrays. This allows you full compatibility with the native PHP arrays functionality.
- Allows you to mix the concept of List and Map.
- We don't encourage its usage. It's here just in case you have to use it.

### Map

`const COLLECTION_TYPE_MAP = 'map'`

- An object that maps keys into values.
- A map cannot contain duplicate keys; each key can map to at most one value.
- The user can search elements by their key (the keys are not sorted).

### List

`const COLLECTION_TYPE_LIST = 'list'`

- An ordered collection (also known as a sequence). 
- The user of this interface has precise control over where in the list each element is inserted. 
- The user can access elements by their integer index (position in the list).

## Immutability

A mutable collection can be changed after it has been created, an immutable cannot. By default, the collections are mutable.

You can specify the collection is mutable or not by overriding this function in your domain:
```php
protected function isMutable(): bool
{
    return false;
}
```

## Nullability

A collection can allow `null` items or not. By default, the collections cannot allow `null`s.

You can specify the collection allows nullable items or not by overriding this function in your domain:
```php
protected function isNullAllowed(): bool
{
    return false;
}
```

## Predefined Scalars

If you only need a string map, or a list of integers, this library already contains all possible scalar combinations for:

| Class                 | Mutable | Scalar  | Type  |
|-----------------------|---------|---------|-------|
| ImmutableBooleanArray | no      | boolean | array |
| ImmutableBooleanList  | no      | boolean | list  |
| ImmutableBooleanMap   | no      | boolean | map   |
| ImmutableFloatArray   | no      | float   | array |
| ImmutableFloatList    | no      | float   | list  |
| ImmutableFloatMap     | no      | float   | map   |
| ImmutableIntegerArray | no      | integer | array |
| ImmutableIntegerList  | no      | integer | list  |
| ImmutableIntegerMap   | no      | integer | map   |
| ImmutableStringArray  | no      | string  | array |
| ImmutableStringList   | no      | string  | list  |
| ImmutableStringMap    | no      | string  | map   |
| MutableBooleanArray   | yes     | boolean | array |
| MutableBooleanList    | yes     | boolean | list  |
| MutableBooleanMap     | yes     | boolean | map   |
| MutableFloatArray     | yes     | float   | array |
| MutableFloatList      | yes     | float   | list  |
| MutableFloatMap       | yes     | float   | map   |
| MutableIntegerArray   | yes     | integer | array |
| MutableIntegerList    | yes     | integer | list  |
| MutableIntegerMap     | yes     | integer | map   |
| MutableStringArray    | yes     | string  | array |
| MutableStringList     | yes     | string  | list  |
| MutableStringMap      | yes     | string  | map   |

## Development

### Working example

You can check some working examples in `example` folder
```bash
# The `ImmutableArticleList` is a wrapper of Article instances
php example/articles.php

# The `IntMatrix` is a list of integer lists (List<List<int>>)
php example/int_matrix.php

# The `PublicationList` uses an interface as typeToEnforce()
php example/interface_publications.php
```

### Git Hooks

Enable the git hooks with `./tools/git-hooks/init.sh`
