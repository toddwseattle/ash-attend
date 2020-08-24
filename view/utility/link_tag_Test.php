<?php
use PHPUNIT\Framework\TestCase;
include_once "link_tag_class.php";
class link_tag_test extends TestCase
{
  public function test_can_create_instance_of_link_tag()
  {
    $test_LinkTag = new link_tag_class();
    $this->assertInstanceOf(link_tag_class::class, $test_LinkTag);
  }
  public function test_defaults_to_empty_link()
  {
    $tl = new link_tag_class();
    $this->assertEquals("#", $tl->get_link());
  }
  public function test_defaults_to_empty_link_description()
  {
    $tl = new link_tag_class();
    $this->assertEquals(link_tag_class::EMPTYLINK, $tl->get_description());
  }
  public function test_generates_correct_default_html()
  {
    $tl = new link_tag_class();
    $tl->set_id("alink");
    $defaultTagHtml =
      "<A id=\"alink\" href=\"#\"" .
      " target=\"_self\"" .
      " >" .
      link_tag_class::EMPTYLINK .
      "</A>";
    $this->assertEquals($tl->get_html(), $defaultTagHtml);
  }
}
