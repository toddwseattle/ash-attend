<?php
use PHPUNIT\Framework\TestCase;
include_once "snippet_class.php";

class snippet_test extends TestCase
{
  public function test_php_unit_loads()
  {
    $this->assertTrue(true);
  }
  public function test_snippet_class_classDefaultsToSpan()
  {
    $snippet = new snippet_class();
    $this->assertEquals($snippet->templateString, "<span>%MARKER%</span>");
  }
  public function test_snippet_class_class_substitutes_simple_marker()
  {
    $snippet = new snippet_class();
    $snippet->content = "Test";
    $this->assertEquals($snippet->get_html(), "<span>Test</span>");
  }
  public function test_snippet_class_class_constructor_with_template_and_content_works()
  {
    $snippet = new snippet_class("<p>%MARKER%</p>", "A Paragraph");
    $this->assertEquals($snippet->get_html(), "<p>A Paragraph</p>");
  }
}
