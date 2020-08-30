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
  public function test_it_should_default_min_role_to_3()
  {
    $actual = (new menu_item_class())->min_role;
    $this->assertEquals(3, $actual);
  }
  public function test_it_should_create_a_min_role_of_1()
  {
    $actual = (new menu_item_class("Admin", "#", "Only Admin", 1))->min_role;
    $this->assertEquals(1, $actual);
  }
  public function test_it_should_not_let_a_role_of_3_access_min_role_of_1()
  {
    $actual = new menu_item_class("Admin", "#", "Only Admin", 1);
    $false_message = $actual->is_visible_for_role(3);
    $this->assertFalse(
      $false_message,
      "_it_should_not_let_a_role_of_3_access_min_role_of_1"
    );
  }
}
