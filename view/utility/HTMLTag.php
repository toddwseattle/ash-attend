<?php
/**
 * iHTMLTag - interface to an HTMLTag
 */
include_once "Snippet.php";
include_once "StringSet.php";
interface iHTMLTag extends iSnippet {
    public function getTag();
    public function setTag(string $tag);
    public function getId();
    public function setId(string $id);
    public function getCssClassString();
    public function removeCssClass(string $cssClass);
    public function addCssClass(string $cssClass);
}
/**
 * extends snippet for a logical representation of an HTMLTag with id and class elements.
 * pass the tag, id, and an array of cssClasses to the constructor.  by default it creates a span with 
 * an auto incremented id of "id<n>".
 */
class HTMLTag extends Snippet implements iHTMLTag
{
    private $tag;
    protected static $idNumber=0;
    public $id;
    public StringSet $cssClasses;
    function __construct(string $tag = "span", string $content = "", string $id =null, array $cssClasses = null) {
        parent::__construct();
        $this->tag=$tag;
        $this->id = $id ?? "id" . self::$idNumber++;
        $this->content = $content;
        $this->cssClasses = new StringSet($cssClasses);
        $this->updateTemplate();
    }
    private function flattenToWords($toFlatten) {
        if(is_string($toFlatten)) {
            return explode(' ', trim($toFlatten));
        } elseif(is_array($toFlatten)) {
            $flat=[];
            foreach ($toFlatten as $value) {
                $flat = array_merge($flat,$this->flattenToWords($value) ?? []);
            }
            return $flat;
        }
    }
    public function getTag(){
        return $this->tag;
    }
    public function setTag(string $tag){
        $this->tag = $tag;
        $this->updateTemplate();
    }
    /**
     * takes @param $name and @param $value and returns
     * $name = "$value"
     * so can be used as an HTML tag attribute.
     * 
     */
    protected function attributeString($name,$value) {
        if(is_string($value) and (strlen($value))>0) {
            return  $name . "=" . "\"" . $value . "\"";
        }
    }
    protected function updateTemplate() {
        if($this->cssClasses->isEmpty()) {
            $this->templateString = "<" . $this->tag . " ". $this->attributeString("id",$this->id) . ">" . 
            $this->marker . "</" . $this->tag . ">";    
        } else
        {
        $this->templateString = "<" . $this->tag . " " . $this->attributeString("id",$this->id). " class=\"" . $this->getCssClassString() . "\">" . 
            $this->marker . "</" . $this->tag . ">";
        }
    }
    public function getId(){
        return $this->id;
    }
    public function setId(string $id){
        $this->id = $id;
        $this->updateTemplate();
    }
    public function getCssClassString(){
        return $this->cssClasses->__toString();
    }
    public function removeCssClass($cssClass){
        $this->cssClasses->remove($cssClass);
        }
    public function addCssClass($cssClass){
        $this->cssClasses->add($cssClass);
    }
    

}
