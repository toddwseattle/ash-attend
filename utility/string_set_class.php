<?php
/**
 * A set that is an array of string tokens; and can be easily turned into a delimited set of
 * strings.  IT was built for things like CSSClasses.  Pass a first string, either with spaces delimiting the items or an array of strings
 */
class string_set_class
{
  private array $contents = [];
  public function __construct($init = [])
  {
    $this->add($init);
  }
  private function to_array($flat)
  {
    return explode(" ", trim($flat));
  }
  public function add($toAdd)
  {
    $addArray = [];
    if (is_array($toAdd)) {
      $addArray = $toAdd;
    } elseif (is_string($toAdd)) {
      $addArray = $this->to_array($toAdd);
    }
    foreach ($addArray as $element) {
      if (
        count($this->to_array($element)) == 1 and
        !array_search($element, $this->contents)
      ) {
        array_push($this->contents, $element);
      } elseif ($this->to_array($element) > 1) {
        $this->add($this->to_array($element));
      }
    }
  }
  public function remove($toRemove)
  {
    $removeArray = [];
    if (is_array($toRemove)) {
      $removeArray = $toRemove;
    } elseif (is_string($toRemove)) {
      $removeArray = $this->to_array($toRemove);
    }
    foreach ($removeArray as $element) {
      $removeKey = array_search($element, $this->contents);
      if ($removeKey !== false) {
        array_splice($this->contents, $removeKey, 1);
      }
    }
  }
  public function __toString()
  {
    return implode(" ", $this->contents);
  }
  public function get_array()
  {
    return $this->contents;
  }
  public function clear_array()
  {
    $this->contents = [];
  }
  public function is_empty()
  {
    return empty($this->contents);
  }
}
