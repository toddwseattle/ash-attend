<?php
use PHPUNIT\Framework\TestCase;
include_once "html_tag_class.php";
class html_tag_test extends TestCase
{
  public function test_html_tagClassDefaultConstructorWorks()
  {
    $tag = new html_tag_class();
    $tag->content = "Test";
    $this->assertEquals($tag->get_html(), "<span id=\"id0\">Test</span>");
  }
  public function tes_tid_auto_increment_works()
  {
    $id0 = new html_tag_class();
    $id0->content = "Test1";
    $id1 = new html_tag_class();
    $id1->content = "Test2";
    $this->assertEquals($id0->get_html(), "<span id=\"id1\">Test1</span>");
    $this->assertEquals($id1->get_html(), "<span id=\"id2\">Test2</span>");
  }
  public function test_css_single_class_works()
  {
    $singleClass = new html_tag_class("P", "A single class", "cl0", ["css1"]);
    $this->assertEquals(
      $singleClass->get_html(),
      "<P id=\"cl0\" class=\"css1\">A single class</P>"
    );
  }
  public function test_multi_css_class_works()
  {
    $multiClass = new html_tag_class("P", "multi-class", "cl1", [
      "css1",
      "css2",
      "css3",
    ]);
    $this->assertEquals(
      $multiClass->get_html(),
      "<P id=\"cl1\" class=\"css1 css2 css3\">multi-class</P>"
    );
  }
  public function test_add_css_class_works()
  {
    $singleClass = new html_tag_class("P", "A single class", "cl0", ["css1"]);
    $singleClass->addCssClass("css2");
    $this->assertEquals($singleClass->get_css_class_string(), "css1 css2");
  }
  public function test_RemoveCssClassWorks()
  {
    $testTag = new html_tag_class("P", "A single class", "cl0", [
      "css1",
      "css2",
    ]);
    $testTag->removeCssClass("css2");
    $this->assertEquals($testTag->get_css_class_string(), "css1");
  }
}
