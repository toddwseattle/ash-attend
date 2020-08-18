<?php
use PHPUNIT\Framework\TestCase;
include_once "../view/utility/snippet.php";

class SnippetTest extends TestCase {
    public function testPhpUnitLoads() {
        $this->assertTrue(TRUE);
    }
    public function testSnippetDefaultsToSpan() {
        $snippet = new Snippet();
        $this->assertEquals($snippet->templateString,"<span>%MARKER%</span>");
    }
    public function testSnippetSubstitutesSimpleMarker() {
        $snippet = new Snippet();
        $snippet->content = "Test";
        $this->assertEquals($snippet->getHTML(),"<span>Test</span>");
    }
    public function testSnippetConstructorWithTemplateAndContentWorks() {
        $snippet = new Snippet("<p>%MARKER%</p>","A Paragraph");
        $this->assertEquals($snippet->getHTML(),"<p>A Paragraph</p>");
    }
}
