<?php
include_once "Snippet.php";
include_once "MenuItem.php";
include_once "StringSet.php";
class Menu implements iSnippet
{
  public Snippet $containerSnippet;
  public array $items = [];

  /**
   * set of css classes for active menu items
   */
  public StringSet $activeCssClasses;
  /** set of classes for disabled menu items
   *
   */
  public StringSet $disabledCssClasses;
  function __construct(array $items = null)
  {
    $this->activeCssClasses = new StringSet();
    $this->disabledCssClasses = new StringSet();
    $this->containerSnippet = new Snippet("<div class=\"menu\">%MARKER%</div>");
    if (
      is_array($items) and
      count($items) > 0 and
      $items[0] instanceof MenuItem
    ) {
      $this->items = $items;
    }
  }
  function getHTML()
  {
    $menuItemsHTML = "";
    foreach ($this->items as $menuItem) {
      if (!$menuItem->enabled) {
        $menuItem->addCssClass($this->disabledCssClasses);
      }
      $menuItemsHTML .= $menuItem->getHTML() . "\n";
      if (!$menuItem->enabled) {
        $menuItemsHTML->removeCssClass($this->disabledCssClasses);
      }
    }
    $this->containerSnippet->content = $menuItemsHTML;
    return $this->containerSnippet->getHTML();
  }
  function setActiveMenu($menuItem)
  {
    foreach ($this->items as $key => $mi) {
      if ($mi->description == $menuItem or $mi->link == $menuItem) {
        $mi->active = true;
        $mi->tag->addCssClass($this->activeCssClasses->getArray());
      } else {
        $mi->active = false;
        $mi->tag->removeCssClass($this->activeCssClasses->getArray());
      }
    }
  }
}
