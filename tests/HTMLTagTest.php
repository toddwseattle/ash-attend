<?php
use PHPUNIT\Framework\TestCase;
include_once "../view/utility/snippet.php";
class HTMLTagTest extends TestCase {
    public function testHTMLTagClassDefaultConstructorWorks() {
        $tag = new HTMLTag();
        $tag->content = "Test";
        $this->assertEquals($tag->getHTML(),"<span id=\"id0\">Test</span>");

    }
    public function testIdAutoIncrementWorks() {
        $id0 = new HTMLTag();
        $id0->content = "Test1";
        $id1 = new HTMLTag();
        $id1->content = "Test2";
        $this->assertEquals($id0->getHTML(),"<span id=\"id1\">Test1</span>");
        $this->assertEquals($id1->getHTML(),"<span id=\"id2\">Test2</span>");
    }
    public function testCssSingleClassWorks() {
        $singleClass = new HTMLTag("P","A single class","cl0",["css1"]);
        $this->assertEquals($singleClass->getHTML(),
        "<P id=\"cl0\" class=\"css1\">A single class</P>");
    }
}