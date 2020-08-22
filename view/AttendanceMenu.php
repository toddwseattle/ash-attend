<?php
include_once "../view/utility/Menu.php";
function ShowAttendanceMenu(string $select = "Home")
{
  $menuItems = [
    new MenuItem("Home", "/"),
    new MenuItem("Login", "login.php"),
    new MenuItem("Record", "attendance_log.php"),
    new MenuItem("Add Student", "./add_student.php"),
  ];

  $menu = new Menu($menuItems);
  $menu->activeCssClasses->add("active-menu");
  $menu->setActiveMenu($select);
  return $menu->getHTML();
}
