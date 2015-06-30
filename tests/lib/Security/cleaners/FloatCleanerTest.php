<?php
/**
 * Created by PhpStorm.
 * User: adam
 * Date: 5/28/15
 * Time: 8:24 PM
 */

namespace Security\cleaners;


class FloatCleanerTest extends \PHPUnit_Framework_TestCase {

    protected $object;


    protected function setUp()
    {
        parent::setUp();
        $this->object = new FloatCleaner();
    }

    /**
     * @covers Security\cleaners\FloatCleaner::sanitize
     */
    public function testSanitize()
    {
        $this->assertEquals(9.3, $this->object->sanitize(9.3));
        $this->assertEquals(9.3, $this->object->sanitize('9.3'));
        $this->assertFalse($this->object->sanitize('taco'));
    }

    /**
     * @covers \Security\cleaners\FloatCleaner::validate
     */
    public function testValidate()
    {
        $this->assertEquals(9.3, $this->object->validate(9.3));
        $this->assertEquals(9.3, $this->object->validate('9.3'));
        $this->assertFalse($this->object->validate('taco'));
    }

    /**
     * @covers \Security\cleaners\FloatCleaner::set_max_length
     */
    public function testSet_max_length()
    {
        $this->object->set_max_length(45);
        $this->assertAttributeEquals(45, 'max_length', $this->object);
    }

}
