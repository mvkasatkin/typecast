<?php

namespace tests;

use Mvkasatkin\typecast\Cast;
use Mvkasatkin\typecast\type\TypeFloat;
use PHPUnit\Framework\TestCase;
use function Mvkasatkin\typecast\cast;

class CastTest extends TestCase
{

    public function testInt()
    {
        $this->assertSame(1, cast(1, Cast::INT));
        $this->assertSame(1, cast('1', Cast::INT));
    }
    
    public function testBool()
    {
        $this->assertTrue(cast(true, Cast::BOOL));
        $this->assertFalse(cast(false, Cast::BOOL));
        $this->assertTrue(cast('1', Cast::BOOL));
        $this->assertFalse(cast('0', Cast::BOOL));
    }
    
    public function testFloat()
    {
        $this->assertSame(1.0, cast(1, Cast::FLOAT));
        $this->assertSame(1.1, cast('1.1', Cast::FLOAT));
        $this->assertSame(0.0, cast('str', Cast::FLOAT));
    }
    
    public function testString()
    {
        $this->assertSame('1', cast(1, Cast::STRING));
        $this->assertSame('str', cast('str', Cast::STRING));
        $this->assertSame('', cast(null, Cast::STRING));
        $this->assertSame('', cast(false, Cast::STRING));
        $this->assertSame('1', cast(true, Cast::STRING));
    }
    
    public function testBinary()
    {
        $string = 'Строка UTF8';
        $string = cast($string, Cast::BINARY);
        $this->assertEquals(11, \strlen($string));
        $this->assertEquals(17, \mb_strlen($string, '8BIT'));
    }
    
    public function testObject()
    {
        $object = cast(['a' => 1], Cast::OBJECT);
        $this->assertInstanceOf(\stdClass::class, $object);
        $this->assertEquals(1, $object->a);
    }
    
    public function testUnset()
    {
        $this->assertNull(cast(1, Cast::UNSET));
    }
    
    public function testArray()
    {
        $this->assertSame([1], cast([1], Cast::ARRAY));
        $this->assertSame([1], cast(1, Cast::ARRAY));
    }
    
    public function testArrayOfType()
    {
        $result = cast([1,2,3, '4', '5.5', 6.6, '7,7', '0', null, false, true], [Cast::FLOAT]);
        $this->assertSame([1.0, 2.0, 3.0, 4.0, 5.5, 6.6, 7.0, 0.0, 0.0, 0.0, 1.0], $result);
    }

    public function testScheme()
    {
        $data = [
            'field.1' => '1',
            'field.2' => '2',
            'field.3' => '3',
            'field.4' => [
                'field.4.1' => ['a', '1', '2'],
                'field.4.2' => '1'
            ],
            'field.5' => '55.5',
            'field.NC' => 'no cast'
        ];
        $scheme = [
            'field.1' => Cast::INT,
            'field.2' => Cast::FLOAT,
            'field.3' => Cast::STRING,
            'field.4' => [
                'field.4.1' => [Cast::FLOAT],
                'field.4.2' => Cast::BOOL,
            ],
            'field.5' => new TypeFloat(111)
        ];
        return $data + $scheme;

        $cast = new Cast($scheme);
        $cast->do($data);

        cast(1, 2);

        // todo заполнять
        // todo strict (unset not in scheme)
        // todo
    }
}
