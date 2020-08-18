<?php
use PHPUNIT\Framework\TestCase;
include_once "StringSet.php";
class StringSetTest extends TestCase {
    public function testCanCreateInstanceOfStringSet(){
        $testStringSet=new StringSet();
        $this->assertInstanceOf(StringSet::class,$testStringSet);
    }
    public function testCanAddAString() {
        $actual=new StringSet("aString");
    $this->assertEquals(1,count($actual->getArray()));
    }
    public function testCanAddArrayOfString() {
        $testSet= new StringSet(["String1","String2"]);
    $this->assertEquals(2,count($testSet->getArray()));
    }
    public function testTurnsSpacedStringToArray() {
        $testSet=new StringSet("String1 String2");
    $this->assertEquals(2,count($testSet->getArray()));
    }
    public function testTurnsSpacedStringArrayToFlatArray() {
        $testSet=new StringSet(["String1 String2"]);
    $this->assertEquals(2,count($testSet->getArray()));
    }
    public function testGetsCombinedStringFromSet() {
        $testSet=new StringSet(["String1","String2"]);
    $this->assertEquals("String1 String2",$testSet);
    }
    public function testRemovesSimpleStringFromSetAtEnd() {
        $testSet=new StringSet(["String1","String2"]);
        $testSet->remove("String2");
        $this->assertEquals(1,count($testSet->getArray()));
    }
    
    public function testRemovesSimpleStringFromSetAtBegin() {
        $testSet=new StringSet(["String1","String2"]);
        $testSet->remove("String1");
        $this->assertEquals(1,count($testSet->getArray()));
    }
    public function testDoesNotModifySetIfRemoveNonMember() {
        $testSet=new StringSet(["String1","String2"]);
        $testSet->remove("String3");
        $this->assertEquals(2,count($testSet->getArray()));
    }
}