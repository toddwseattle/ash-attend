<?php
/**A set that is an array of string tokens; and can be easily turned into a delimited set of 
 * strings.  IT was built for things like CSSClasses.  Pass a first string, either with spaces delimiting the items or an array of strings
 */
class StringSet
{
    private array $contents=[];
    public function __construct($init=[]) {
        $this->add($init);
    }
    private function toArray($flat) {
        return explode(" ",trim($flat));
    }
    public function add($toAdd) {
        $addArray=[];
        if (is_array($toAdd)) {
            $addArray = $toAdd;
        } elseif(is_string($toAdd)) {
            $addArray = $this->toArray($toAdd);
        }
        foreach ($addArray as $element) {
            if(count($this->toArray($element))==1 and !array_search($element, $this->contents)) {
                array_push($this->contents,$element);
            } elseif($this->toArray($element)>1) {
                $this->add($this->toArray($element));
            }
        }
    }
    public function remove($toRemove) {
        $removeArray=[];
        if (is_array($toRemove)) {
            $removeArray = $toRemove;
        } elseif(is_string($toRemove)) {
            $removeArray = $this->toArray($toRemove);
        }
        foreach ($removeArray as $element) {

            $removeKey = array_search($element, $this->contents);
            if($removeKey!==false) {
                array_splice($this->contents,$removeKey,1);
            }
        }
    }
    public function __toString() {
            return implode(" ",$this->contents);
    }
    public function getArray() {
        return $this->contents;
    }
    public function clearArray() {
        $this->contents = [];
    }
    public function isEmpty() {
        return empty($this->contents);
    }
    
}
