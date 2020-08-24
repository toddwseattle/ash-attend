<?php
/**
 * iHTMLTag - interface to an html_tag_class
 */
include_once "snippet_class.php";
include_once "string_set_class.php";
interface ihtml_tag extends i_snippet
{
  public function get_tag();
  public function setTag(string $tag);
  public function get_id();
  public function set_id(string $id);
  public function get_css_class_string();
  public function removeCssClass(string $cssClass);
  public function addCssClass(string $cssClass);
}
/**
 * extends snippet for a logical representation of an html_tag_class with id and class elements.
 * pass the tag, id, and an array of cssClasses to the constructor.  by default it creates a span with
 * an auto incremented id of "id<n>".
 */
class html_tag_class extends snippet_class implements ihtml_tag
{
  private $tag;
  protected static $idNumber = 0;
  public $id;
  public string_set_class $cssClasses;
  function __construct(
    string $tag = "span",
    string $content = "",
    string $id = null,
    array $cssClasses = null
  ) {
    parent::__construct();
    $this->tag = $tag;
    $this->id = $id ?? "id" . self::$idNumber++;
    $this->content = $content;
    $this->cssClasses = new string_set_class($cssClasses);
    $this->update_template();
  }
  private function flattenToWords($toFlatten)
  {
    if (is_string($toFlatten)) {
      return explode(' ', trim($toFlatten));
    } elseif (is_array($toFlatten)) {
      $flat = [];
      foreach ($toFlatten as $value) {
        $flat = array_merge($flat, $this->flattenToWords($value) ?? []);
      }
      return $flat;
    }
  }
  public function get_tag()
  {
    return $this->tag;
  }
  public function setTag(string $tag)
  {
    $this->tag = $tag;
    $this->update_template();
  }
  /**
   * takes @param $name and @param $value and returns
   * $name = "$value"
   * so can be used as an HTML tag attribute.
   *
   */
  protected function attribute_string($name, $value)
  {
    if (is_string($value) and strlen($value) > 0) {
      return $name . "=" . "\"" . $value . "\"";
    }
  }
  protected function update_template()
  {
    if ($this->cssClasses->is_empty()) {
      $this->templateString =
        "<" .
        $this->tag .
        " " .
        $this->attribute_string("id", $this->id) .
        ">" .
        $this->marker .
        "</" .
        $this->tag .
        ">";
    } else {
      $this->templateString =
        "<" .
        $this->tag .
        " " .
        $this->attribute_string("id", $this->id) .
        " class=\"" .
        $this->get_css_class_string() .
        "\">" .
        $this->marker .
        "</" .
        $this->tag .
        ">";
    }
  }
  public function get_id()
  {
    return $this->id;
  }
  public function set_id(string $id)
  {
    $this->id = $id;
    $this->update_template();
  }
  public function get_css_class_string()
  {
    return $this->cssClasses->__toString();
  }
  public function removeCssClass($cssClass)
  {
    $this->cssClasses->remove($cssClass);
  }
  public function addCssClass($cssClass)
  {
    $this->cssClasses->add($cssClass);
  }
}
