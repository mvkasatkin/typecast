<?php

require '../vendor/autoload.php';

use \Mvkasatkin\typecast\Cast;
use function \Mvkasatkin\typecast\cast;
use Mvkasatkin\typecast\type\TypeInt;

cast('120', Cast::INT); // => 120 - same as (int)'120'
cast(120, Cast::FLOAT); // => 120.0 - same as (float)120
cast('1', Cast::BOOL); // => true - same as (true)'1'
cast(120, Cast::STRING); // => '120' - same as (string)120
cast('120', Cast::BINARY); // => '120' - binary string, same as (binary)'120'
cast(['a' => 1], Cast::OBJECT); // => stdClass - same as (object)['a' => 1']
cast('120', Cast::UNSET); // => null - same as (unset)'120'
cast('120', Cast::ARRAY); // => ['120'] - same as (array)'120'
cast('120', new TypeInt()); // => ['120'] - same as (array)'120'
