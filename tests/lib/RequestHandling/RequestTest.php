<?php

namespace RequestHandling;

/**
 * Generated by PHPUnit_SkeletonGenerator 1.2.1 on 2014-09-16 at 14:52:53.
 */
class RequestTest extends \PHPUnit_Framework_TestCase
{
    public static $testnonce = "aeab0d78b129c0391e8316aafa479fc07956fe752ea0ec2de4709e3c212d7a25";
    static public $testarray = array('task' => 'testRequest', 'value' => 4, 'arrayfortest' => array('test1' => 1));
    static public $testarray2 = array('task2' => 'testRequest', 'value2' => 4, 'arrayfortest2' => array('test1' => 1));
    static public $testarray3 = array('please' => 'pleaseRequest', 'value3' => 4,
        'formToken' => "aeab0d78b129c0391e8316aafa479fc07956fe752ea0ec2de4709e3c212d7a25", 'arrayfortest3' => array('test3' => 1));
    static public $testarray4 = array('please' => 'pleaseRequest', 'pageName' => 'testPageName', 'value3' => 4,
        'formToken' => "aeab0d78b129c0391e8316aafa479fc07956fe752ea0ec2de4709e3c212d7a25", 'arrayfortest3' => array('test3' => 1));

    /**
     * @var Request
     */
    protected $object;

    /**
     * Sets up the fixture, for example, opens a network connection.
     * This method is called before a test is executed.
     */
    protected function setUp()
    {
        parent::setUp();
        $_POST = array();
        $_GET = array();

        $this->object = new Request();
    }

    /**
     * Tears down the fixture, for example, closes a network connection.
     * This method is called after a test is executed.
     */
    protected function tearDown()
    {
        unset($_POST);
        unset($_GET);
    }

    /**
     * @covers \RequestHandling\Request::load
     */
    public function testLoad()
    {
        $this->assertEmpty($this->object->get);
        $this->assertEmpty($this->object->post);
        $this->assertEmpty($this->object->http);
        $_POST['testpost'] = 'testpost';
        $_GET['testget'] = 'testget';
        $this->object->load();
        $this->assertNotEmpty($this->object->get);
        $this->assertNotEmpty($this->object->post);
        $this->assertNotEmpty($this->object->http);
        $this->assertEquals('testpost', $this->object->http['testpost']);
        $this->assertEquals('testget', $this->object->http['testget']);
    }

    /**
     * @covers \RequestHandling\Request::unset_incoming
     */
    public function testUnset_incoming()
    {
        foreach (self::$testarray as $k => $v) {
            $_POST[$k] = $v;
        }
        foreach (self::$testarray2 as $k => $v) {
            $_GET[$k] = $v;
        }
        $this->object->load();
        $this->object->unset_incoming();
        $this->assertFalse(isset($_GET));
        $this->assertFalse(isset($_POST));
    }

    /**
     * @covers \RequestHandling\Request::load_get
     */
    public function testLoad_get()
    {
        foreach (self::$testarray as $k => $v) {
            $_GET[$k] = $v;
        }
        $this->object->load_get();
        foreach (self::$testarray as $k => $v) {
            $this->assertArrayHasKey($k, $this->object->get);
        }
        foreach ($this->object->get as $k => $v) {
            $this->assertEquals($v, self::$testarray[$k]);
        }
    }

    /**
     * @covers \RequestHandling\Request::load_post
     */
    public function testLoad_post()
    {
        foreach (self::$testarray as $k => $v) {
            $_POST[$k] = $v;
        }
        $this->object->load_post();
        foreach (self::$testarray as $k => $v) {
            $this->assertArrayHasKey($k, $this->object->post);
        }
        foreach ($this->object->post as $k => $v) {
            $this->assertEquals($v, self::$testarray[$k]);
        }
    }

    /**
     * @covers \RequestHandling\Request::combine
     */
    public function testCombine()
    {
        foreach (self::$testarray as $k => $v) {
            $_POST[$k] = $v;
        }
        foreach (self::$testarray2 as $k => $v) {
            $_GET[$k] = $v;
        }
        $this->object->load_get();
        $this->object->load_post();
        $this->object->combine();
        $combined = array_merge(self::$testarray, self::$testarray2);
        foreach ($combined as $k => $v) {
            $this->assertArrayHasKey($k, $this->object->http);
            $this->assertEquals($v, $this->object->http[$k]);
        }
    }

    /**
     * @covers \RequestHandling\Request::task
     */
    public function testTask()
    {
        foreach (self::$testarray as $k => $v) {
            $_POST[$k] = $v;
        }
        $this->object->load();
        $this->assertEquals('testRequest', $this->object->task());

        foreach (self::$testarray3 as $k => $v) {
            $_POST[$k] = $v;
        }
        $this->object->load();
        $this->assertEquals('pleaseRequest', $this->object->task());
    }

//    /**
//     * @covers \RequestHandling\Request::nonce
//     */
//    public function testNonce()
//    {
//        foreach (self::$testarray3 as $k => $v) {
//            $_POST[$k] = $v;
//        }
//        $this->object->load();
//        $this->assertEquals(self::$testnonce, $this->object->nonce());
//    }
//

    /**
     * @covers \RequestHandling\Request::page_name
     */
    public function testPage_name()
    {
        foreach (self::$testarray4 as $k => $v) {
            $_POST[$k] = $v;
        }
        $this->object->load();
        $result = $this->object->page_name();
        $this->assertEquals('testPageName', $result);
    }

    /**
     * @covers \RequestHandling\Request::create
     */
    public function testCreate()
    {
        $_POST['testpost'] = 'testpost';
        $_GET['testget'] = 'testget';

        $object = Request::create();
        $this->assertNotEmpty($object->get);
        $this->assertNotEmpty($object->post);
        $this->assertNotEmpty($object->http);
        $this->assertEquals('testpost', $object->http['testpost']);
        $this->assertEquals('testget', $object->http['testget']);
    }
}