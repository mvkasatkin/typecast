# Typecast

[![Build Status](https://travis-ci.org/mvkasatkin/typecast.svg?branch=master)](https://travis-ci.org/mvkasatkin/typecast)
[![Coverage Status](https://coveralls.io/repos/github/mvkasatkin/typecast/badge.svg?branch=master)](https://coveralls.io/github/mvkasatkin/typecast?branch=master)
[![Scrutinizer Code Quality](https://scrutinizer-ci.com/g/mvkasatkin/typecast/badges/quality-score.png?b=master)](https://scrutinizer-ci.com/g/mvkasatkin/typecast/?branch=master)
[![Latest Stable Version](https://poser.pugx.org/mvkasatkin/typecast/version)](https://packagist.org/packages/mvkasatkin/typecast)
[![License](https://poser.pugx.org/mvkasatkin/typecast/license)](https://packagist.org/packages/mvkasatkin/typecast)

Simple library for type casting of scalar variables or array data by **configurable scheme with nested levels**.

## Installation

```
composer require mvkasatkin/typecast
```

## Usage

### Scalar type casting

simple types

```php
use \Mvkasatkin\typecast\Cast;
use function \Mvkasatkin\typecast\cast;

cast('120',      Cast::INT);    // => 120 - same as (int)'120'
cast(120,        Cast::FLOAT);  // => 120.0 - same as (float)120
cast('1',        Cast::BOOL);   // => true - same as (true)'1'
cast(120,        Cast::STRING); // => '120' - same as (string)120
cast('120',      Cast::BINARY); // => '120' - binary string, same as (binary)'120'
cast('120',      Cast::ARRAY);  // => ['120'] - same as (array)'120'
cast('120',      Cast::UNSET);  // => null - same as (unset)'120'
cast(['a' => 1], Cast::OBJECT); // => stdClass - same as (object)['a' => 1']
```

array of type

```php
use \Mvkasatkin\typecast\Cast;
use function \Mvkasatkin\typecast\cast;

cast(['1', 2, 3.0, null], [Cast::FLOAT]); // => [1.0, 2.0, 3.0, null]
```

custom type casting by closure

```php
use \Mvkasatkin\typecast\Cast;
use function \Mvkasatkin\typecast\cast;

cast('1', function($value) { return (int)$value + 1; });   // => 2
```

with default value (by default = null)

```php
use \Mvkasatkin\typecast\Cast;
use \Mvkasatkin\typecast\type\TypeInt;
use function \Mvkasatkin\typecast\cast;

cast('110', new TypeInt(140));   // => 110
cast(null, new TypeInt(140));   // => 140
```

### Type casting by scheme

```php
$importData = [...]; // some external data
$scheme = [
    'field.1' => Cast::INT,
    'field.2' => Cast::FLOAT,
    'field.3' => [
        'field.3.ids' => [Cast::INT], // array of integers
        'field.3.name' => Cast::STRING,
        'field.3.price' => function($value) { /* custom type casting */ }
    ],
    'field.4' => new TypeBool(false), // default false
];

$safeData = cast($importData, $scheme);
```

### Strict scheme

A strict scheme will remove keys that are not in the scheme and add the keys with default values that it contains,
but are not present in the input data.

```php
$importData = [...]; // some external data
$scheme = [...]; // previous scheme
$strict = true;

$safeData = cast($importData, $scheme, $strict);
```

### Alternative object style

```php
$scheme = new scheme([
    'field.1' => new TypeInt(),
    'field.2' => new TypeFloat(),
    'field.3' => [
        'field.3.ids' => new TypeArrayOfType(new TypeInt()), // array of integers
        'field.3.name' => new TypeString(),
        'field.3.price' => new TypeClosure(function($value) { /* custom type casting */ })
    ],
    'field.4' => new TypeBool(false), // default false
]);

$cast = new Cast($scheme)
$cast->process($importData); // useful in iterations
```