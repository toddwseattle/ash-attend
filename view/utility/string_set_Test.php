<?php
use PHPUNIT\Framework\TestCase;
include_once "string_set_class.php";
class string_set_test extends TestCase
{
  public function test_can_create_instance_of_string_set_class()
  {
    $test_string_set_class = new string_set_class();
    $this->assertInstanceOf(string_set_class::class, $test_string_set_class);
  }
  public function test_can_add_a_string()
  {
    $actual = new string_set_class("aString");
    $this->assertEquals(1, count($actual->get_array()));
  }
  public function test_can_add_array_of_string()
  {
    $test_set = new string_set_class(["String1", "String2"]);
    $this->assertEquals(2, count($test_set->get_array()));
  }
  public function test_turns_spaced_string_to_array()
  {
    $test_set = new string_set_class("String1 String2");
    $this->assertEquals(2, count($test_set->get_array()));
  }
  public function test_turns_spaced_string_array_to_flat_array()
  {
    $test_set = new string_set_class(["String1 String2"]);
    $this->assertEquals(2, count($test_set->get_array()));
  }
  public function test_gets_combined_string_from_set()
  {
    $test_set = new string_set_class(["String1", "String2"]);
    $this->assertEquals("String1 String2", $test_set);
  }
  public function test_removes_simple_string_from_set_at_end()
  {
    $test_set = new string_set_class(["String1", "String2"]);
    $test_set->remove("String2");
    $this->assertEquals(1, count($test_set->get_array()));
  }

  public function test_removes_simple_string_from_set_at_begin()
  {
    $test_set = new string_set_class(["String1", "String2"]);
    $test_set->remove("String1");
    $this->assertEquals(1, count($test_set->get_array()));
  }
  public function test_does_not_modify_set_if_remove_non_member()
  {
    $test_set = new string_set_class(["String1", "String2"]);
    $test_set->remove("String3");
    $this->assertEquals(2, count($test_set->get_array()));
  }
}
