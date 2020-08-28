<?php
include_once "../utility/menu_class.php";
/**
 * generate an class_menu with the default attendance menu items.  Activate the menu passed as description.
 */
function create_attendance_menu(string $select = "Dashboard")
{
  $menuItems = [
    new menu_item_class("Home", "/ash-attend"),
    new menu_item_class("Dashboard", "dashboard.php"),
    new menu_item_class("Record", "attendance_log.php"),
    new menu_item_class("Add Student", "add_student.php"),
  ];
  $menu = new menu_class($menuItems);
  $menu->activeCssClasses->add("active-menu");
  $menu->setActiveMenu($select);
  return $menu;
}
