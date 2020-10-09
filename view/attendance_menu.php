<?php
include_once "../settings/core.php";
include_once "../utility/menu_class.php";
/**
 * generate an class_menu with the default attendance menu items.  Activate the menu passed as description.
 */
function create_attendance_menu(string $select = "Dashboard")
{
  $menuItems = [
    new menu_item_class("Home", "/ash-attend", "Opening Screen", 3),
    new menu_item_class("Dashboard", "dashboard.php", "Your Dashboard", 3),
    new menu_item_class("Mark", "mark_attendance.php","Mark attendance",3),
    new menu_item_class("Past", "attendance_log.php", "Past Attendance", 3),
    new menu_item_class(
      "Add Student",
      "add_student.php",
      "Add Student with email",
      2
    ),
    new menu_item_class(
      "Sessions",
      "manage_sessions.php",
      "Add, Remove, and Edit sessions",
      1
    ),
    new menu_item_class("Approve","manage_attendance.php","Approve or manage pending attendance", 2),
    new menu_item_class("Logout","../login/logout.php","Log Out of Attendance system",3)
  ];
  $menu = new menu_class($menuItems);
  $curr_permission = get_user_permission();

  $menu->current_role = $curr_permission ? $curr_permission : 3;
  $menu->activeCssClasses->add("active-menu");
  $menu->setActiveMenu($select);
  return $menu;
}
