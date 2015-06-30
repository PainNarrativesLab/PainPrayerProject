<?php
/**
 * Created by PhpStorm.
 * User: adam
 * Date: 5/28/15
 * Time: 8:44 PM
 */

namespace Security\cleaners;


class IntegerCleanerTest extends \PHPUnit_Framework_TestCase {

    protected $object; 
    
    protected function setUp()
    {
        parent::setUp();
        $this->object = new IntegerCleaner;
    }
    /**
     * @covers \Security\cleaners\IntegerCleaner::sanitize
     */
    public function testSanitize()
    {
        $this->assertEquals(9, $this->object->sanitize(9));
        $this->assertEquals(9, $this->object->sanitize('9'));
        $this->assertFalse($this->object->sanitize('taco'));
    }

    /**
     * @covers \Security\cleaners\IntegerCleaner::validate
     */
    public function testValidate()
    {
        $this->assertEquals(9, $this->object->validate(9));
        $this->assertEquals(9, $this->object->validate('9'));
        $this->assertFalse($this->object->validate('taco'));
    }

    /**
     * @covers \Security\cleaners\IntegerCleaner::set_max_length
     */
    public function testSet_max_length()
    {
        $this->object->set_max_length(45);
        $this->assertAttributeEquals(45, 'max_length', $this->object);
    }

    /**
     * @covers \Security\cleaners\IntegerCleaner::trim
     */
    public function testTrim(){}
}
