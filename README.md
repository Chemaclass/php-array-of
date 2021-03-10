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

    protected function isMutable(): bool
    {
        return false;
    }

    protected function collectionType(): string
    {
        return self::COLLECTION_TYPE_LIST;
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

You can specify if your collection is mutable or not by overriding this function in your domain:
```php
protected function isMutable(): bool
{
    return false;
}
```

## Predefined Scalars

If you only need a string map, or a list of integers, this library already contains all possible scalar combinations for:

| Class                 | Scalar  | Mutable | Type  |
|-----------------------|---------|---------|-------|
| ImmutableBooleanArray | boolean | no      | array |
| ImmutableBooleanList  | boolean | no      | list  |
| ImmutableBooleanMap   | boolean | no      | map   |
| ImmutableFloatArray   | float   | no      | array |
| ImmutableFloatList    | float   | no      | list  |
| ImmutableFloatMap     | float   | no      | map   |
| ImmutableIntegerArray | integer | no      | array |
| ImmutableIntegerList  | integer | no      | list  |
| ImmutableIntegerMap   | integer | no      | map   |
| ImmutableStringArray  | string  | no      | array |
| ImmutableStringList   | string  | no      | list  |
| ImmutableStringMap    | string  | no      | map   |
| MutableBooleanArray   | boolean | yes     | array |
| MutableBooleanList    | boolean | yes     | list  |
| MutableBooleanMap     | boolean | yes     | map   |
| MutableFloatArray     | float   | yes     | array |
| MutableFloatList      | float   | yes     | list  |
| MutableFloatMap       | float   | yes     | map   |
| MutableIntegerArray   | integer | yes     | array |
| MutableIntegerList    | integer | yes     | list  |
| MutableIntegerMap     | integer | yes     | map   |
| MutableStringArray    | string  | yes     | array |
| MutableStringList     | string  | yes     | list  |
| MutableStringMap      | string  | yes     | map   |

## Development

### Working example

You can check it out a working example of a custom "Immutable List" inside the [example/index.php](example/index.php)

### Git Hooks

Enable the git hooks with `./tools/git-hooks/init.sh`
