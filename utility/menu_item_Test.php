<?php
use PHPUNIT\Framework\TestCase;
include_once "menu_item_class.php";
class menu_item_test extends TestCase
{
  public function test_empty_constructor_works()
  {
    $mu = new menu_item_class();
    $this->AssertInstanceOf(menu_item_class::class, $mu);
  }
  public function test_EmptyConstructorNotNull()
  {
    $mu = new menu_item_class();
    $this->AssertNotNull($mu);
  }
  public function test_EmptyConstructorDefaultLinkIsOk()
  {
    $mu = new menu_item_class('Blank', '#');
    $this->AssertEquals("#", $mu->link);
  }
  public function test_EmptyConstructorDefaultDescriptionIsBlank()
  {
    $mu = new menu_item_class();
    $this->AssertEquals("Blank", $mu->description);
  }
  public function test_it_should_have_an_html_tag_member_by_default()
  {
    $mu = new menu_item_class();
    $this->AssertEquals($mu->tag->get_tag(), "A");
  }
  public function test_ItShouldHaveADefaultIdOfMiBlank()
  {
    $mu = new menu_item_class();
    $this->AssertEquals($mu->tag->get_id(), "mi-Blank");
  }
  public function test_ItShouldHaveDefaultHelpText()
  {
    $mu = new menu_item_class();
    $this->AssertEquals($mu->help, "Navigate to " . "Blank");
  }
  public function test_ShouldCreateDefaultItemHtml()
  {
    $actual = (new menu_item_class())->get_html();
    $expected = <<<_EXPECT
<A id="mi-Blank" href="#" target="_self" class="menu-item">Blank</A>
_EXPECT;
    $this->assertEquals($expected, $actual);
  }
}
