<?php
include_once"./utility/Menu.php";
function ShowAttendanceMenu(string $select = "Login")
{
    $menuItems=[new MenuItem("Login","/login/login.php"), 
    new MenuItem("Record","/attendance_log.php"),
    new MenuItem("Add Student","/add_student")];
    $menu = new Menu($menuItems);
    $menu->activeCssClasses->add("active-menu");
    $menu->setActiveMenu($select);
    return  $menu->getHTML();
}
