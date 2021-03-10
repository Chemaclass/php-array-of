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
The difference is that they are different. 
Map is a mapping of key/values, a list of a list of items.

## Requirements

Requires PHP >= 7.4

## Installation

```
composer require chemaclass/typed-arrays
```

## Collection Types

### List

`const COLLECTION_TYPE_LIST = 'list'`

- An ordered collection (also known as a sequence). 
- The user of this interface has precise control over where in the list each element is inserted. 
- The user can access elements by their integer index (position in the list), and search for elements in the list.

### Map

`const COLLECTION_TYPE_MAP = 'map'`

- An object that maps keys to values. 
- A map cannot contain duplicate keys; each key can map to at most one value.

### Array

`const COLLECTION_TYPE_ARRAY = 'array'`

- Similar as native PHP arrays. This allows you full compatibility with the native PHP arrays functionality. 
- Allows you to mix the concept of List and Map.
- We don't encourage its usage. It's here just in case you have to use it.

You can specify the collection type by overriding this function in your domain:
```php
protected function collectionType(): string
{
    return self::COLLECTION_TYPE_ARRAY;
}
```

## Immutability

You can specify if your collection is mutable or not by overriding this function in your domain:
```php
protected function isMutable(): bool
{
    return true;
}
```

## Predefined Scalars

This library contains already all possible scalar combinations for:

- Immutable, Mutable
- Boolean, Float, Integer, String
- List, Map, Array

## Development

### Git Hooks

Enable the git hooks with `./tools/git-hooks/init.sh`

### Working example

You can check it out a working example of a custom "Immutable List" inside the [example/index.php](example/index.php)
