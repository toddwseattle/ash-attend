<?php
include_once INCLUDE_PREFIX . "/view/utility/menu_class.php";
/**
 * generate an class_menu with the default attendance menu items.  Activate the menu passed as description.
 */
function create_attendance_menu(string $select = "Home", $url_prefix = "")
{
  $menuItems = [
    new menu_item_class("Home", $url_prefix),
    new menu_item_class("Login", $url_prefix . "/login/login.php"),
    new menu_item_class(
      "Record",
      $_SERVER['ASH-ATTEND'] . $url_prefix . "/view/attendance_log.php"
    ),
    new menu_item_class(
      "Add Student",
      $_SERVER['ASH-ATTEND'] . $url_prefix . "/view/add_student.php"
    ),
  ];
  $menu = new menu_class($menuItems);
  $menu->activeCssClasses->add("active-menu");
  $menu->setActiveMenu($select);
  return $menu;
}
