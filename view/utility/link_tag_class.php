<?php
include_once "html_tag_class.php";
/** An HTML "a" tag derived from html_tag_class.  constructor takes a link, description, and id */
class link_tag_class extends html_tag_class implements ihtml_tag
{
  private $link = "#";
  private $target = "_self";
  private $description;
  const EMPTYLINK = "Empty Link";
  function __construct(string $link = "#", $description = null, $id = null)
  {
    if ($link == "#" && !$description) {
      $description = self::EMPTYLINK;
    } elseif (!$description) {
      $description = $link;
    }
    $id = $id ?? "a" . strval(self::$idNumber++);
    parent::__construct("A", $description, $id);
    $this->description = $description;
    $this->link = $link;
    $this->update_template();
  }
  protected function update_template()
  {
    # opening
    $this->templateString =
      "<" .
      $this->get_tag() .
      " " .
      $this->attribute_string("id", $this->id) .
      " " .
      $this->attribute_string("href", $this->link) .
      " " .
      $this->attribute_string("target", $this->target) .
      " " .
      $this->attribute_string("class", $this->get_css_class_string()) .
      ">";
    # content
    $this->templateString .= $this->marker;
    $this->templateString .= "</" . $this->get_tag() . ">";
  }
  /** get the private property $this->link */
  function get_link()
  {
    return $this->link;
  }
  /**set the link property to @param $link */
  function set_link($link)
  {
    $this->link = $link;
    $this->update_template();
  }
  function set_description($description)
  {
    $this->description = $description;
    $this->update_template();
  }
  function get_description()
  {
    return $this->description;
  }
}
