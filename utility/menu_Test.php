<?php
use PHPUNIT\Framework\TestCase;
include_once "menu_class.php";
include_once "menu_item_class.php";
class menu_test extends TestCase
{
  public function test_can_create_instance_of_menu()
  {
    $testMenu = new menu_class();
    $this->assertInstanceOf(menu_class::class, $testMenu);
  }
  public function test_creates_default_container_snippet()
  {
    $testMenu = new menu_class();
    $actual = $testMenu->container_snippet->templateString;
    $this->assertEquals("<div class=\"menu\">%MARKER%</div>", $actual);
  }
  public function test_default_instance_returns_empty_div()
  {
    $testMenu = new menu_class();
    $actualHTML = $testMenu->get_html();
    $this->assertEquals("<div class=\"menu\"></div>", $actualHTML);
  }
  public function createAMenuWithItems($numItems = 3)
  {
    $items = [];
    for ($i = 0; $i < $numItems; $i++) {
      $item = new menu_item_class("Menu" . $i, "/menu" . $i);
      array_push($items, $item);
    }
    return new menu_class($items);
  }
  public function createAMenuWithItemsWithRole($numItems = 3, $role = 3)
  {
    $newMenu = $this->createAMenuWithItems($numItems);
    foreach ($newMenu->items as $mi) {
      $mi->min_role = $role;
    }
    return $newMenu;
  }
  public function test_creates_a_menu_with_3_items()
  {
    $menu = $this->createAMenuWithItems(3);
    $this->assertEquals(3, count($menu->items));
  }
  public function test_html_has_menu_text_of_3_item_menu()
  {
    $testMenu = $this->createAMenuWithItems(3);
    $menuHTML = $testMenu->get_html();
    # echo $menuHTML;
    $actual = true;
    for ($i = 0; $i < 3; $i++) {
      ($actual = $actual) and strpos($menuHTML, "Menu" . $i) != false;
    }
    $this->assertEquals(true, $actual);
  }
  public function test_can_set_active_menu_by_description()
  {
    $testMenu = $this->createAMenuWithItems(3);
    $activeMI = $testMenu->items[0];
    $testMenu->setActiveMenu($activeMI->description);
    $this->assertTrue(
      $testMenu->items[0]->active,
      $activeMI->description . " is Active"
    );
  }
  public function test_can_activate_and_deactivate_by_description()
  {
    $testMenu = $this->createAMenuWithItems(3);
    $activeMI = $testMenu->items[0];
    $testMenu->setActiveMenu($activeMI->description);
    $boolExp = $testMenu->items[0]->active;
    $newActiveMI = $testMenu->items[1];
    $testMenu->setActiveMenu($newActiveMI->description);
    $testMenu->items[0]->active;
    $boolExp = ($boolExp and !$testMenu->items[0]->active);
    $this->assertTrue($boolExp, "Activated/Deactivate Works");
  }
  public function test_can_hide_all_menus_base_on_min_role()
  {
    $menu = $this->createAMenuWithItemsWithRole(3, 1);
    // all menus are faculty level
    $menu->current_role = 3;
    $emptyMenu = $menu->get_html();
    $actual = $menu->container_snippet->content;
    $expected = "";
    $actual = $this->assertEquals($expected, $actual);
  }
}
