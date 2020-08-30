<?php
include_once "snippet_class.php";
include_once "html_tag_class.php";
include_once "link_tag_class.php";
/**
 * A menu_item_class  pass $description, $link, $help, $id, and $role to the constructor.  by default
 * produces href="$link" id="$id" $descriptions .  $help is not yet used.
 * $role defaults to 3 (student) used by check role
 */
class menu_item_class implements i_snippet
{
  public $description;
  public $help;
  public $link;
  public $min_role; // the minimum role for the user to have to see the menu; usually a number

  public bool $enabled = true;
  public bool $active = false;
  public ?link_tag_class $tag;
  function __construct(
    $description = "Blank",
    $link = "#",
    $help = null,
    $min_role = 3,
    $id = null
  ) {
    $this->description = $description;
    $this->link = $link;
    $firstWord = explode(' ', trim($description))[0];
    $id = $id ?? 'mi-' . $firstWord;
    if (empty($help)) {
      $this->help = "Navigate to " . $description;
    } else {
      $this->help = $help;
    }
    $this->tag = new link_tag_class($link, $description, $id);
    $this->tag->addCssClass('menu-item');
    $this->min_role = $min_role;
  }
  function is_visible_for_role($role)
  {
    return $this->min_role >= $role;
  }
  function get_html()
  {
    $this->update_html_tag();
    return $this->tag->get_html();
  }
  function update_html_tag()
  {
    if (!$this->tag) {
      $this->tag = new link_tag_class($description, $id);
      $this->tag->addCssClass('menu-item');
    } else {
      $this->tag->set_description($this->description);
      $this->tag->set_link($this->link);
    }
  }
}
