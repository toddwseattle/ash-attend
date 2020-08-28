<?php
include_once "snippet_class.php";
include_once "menu_item_class.php";
include_once "string_set_class.php";
class menu_class implements i_snippet
{
  public snippet_class $container_snippet;
  public array $items = [];

  /**
   * set of css classes for active menu items
   */
  public string_set_class $activeCssClasses;
  /** set of classes for disabled menu items
   *
   */
  public string_set_class $disabledCssClasses;
  function __construct(array $items = null)
  {
    $this->activeCssClasses = new string_set_class();
    $this->disabledCssClasses = new string_set_class();
    $this->container_snippet = new snippet_class(
      "<div class=\"menu\">%MARKER%</div>"
    );
    if (
      is_array($items) and
      count($items) > 0 and
      $items[0] instanceof menu_item_class
    ) {
      $this->items = $items;
    }
  }
  function get_html()
  {
    $menuItemsHTML = "";
    foreach ($this->items as $menu_item) {
      if (!$menu_item->enabled) {
        $menu_item->addCssClass($this->disabledCssClasses);
      }
      $menuItemsHTML .= $menu_item->get_html() . "\n";
      if (!$menu_item->enabled) {
        $menuItemsHTML->removeCssClass($this->disabledCssClasses);
      }
    }
    $this->container_snippet->content = $menuItemsHTML;
    return $this->container_snippet->get_html();
  }
  function setActiveMenu($menu_item)
  {
    foreach ($this->items as $key => $mi) {
      if ($mi->description == $menu_item or $mi->link == $menu_item) {
        $mi->active = true;
        $mi->tag->addCssClass($this->activeCssClasses->get_array());
      } else {
        $mi->active = false;
        $mi->tag->removeCssClass($this->activeCssClasses->get_array());
      }
    }
  }
}
