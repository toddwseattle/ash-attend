<?php
interface iSnippet
{
    public function getHTML();
}
/**
 * Snippet class implements a way of doing html snippets with simple substitution.  put %MARKER% in $templateString
 * and getHTML will put $content where the marker is
 */
class Snippet implements iSnippet
{
    // template used to create the html.  by default it's a span
    public $templateString = "<span>%MARKER%</span>";
    public $marker = "%MARKER%";
    
    public $content = "empty snippet";
    function __construct(string $templateString = "<span>%MARKER%</span>", string $content = "")
    {
        $this->templateString = $templateString;
        $this->content = $content;
    }
    /**
     * get_html returns html that can be directly echoed to the page based on snippet construction.  In the default
     * implementation it replaces the $marker text in the $templateString with the $content property.
     */
    function getHTML()
    {
        return (str_replace($this->marker, $this->content, $this->templateString));
    }
}

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
 * extends snippet for a logical representation of an HTMLtag with id and class elements.
 * pass the tag, id, and an array of cssClasses to the constructor.  by default it creates a span with 
 * an auto incremented id of "id<n>".
 */
class HTMLTag extends Snippet implements iHTMLTag
{
    private $tag;
    private static $idNumber=0;
    public $id;
    public $cssClasses = [];
    function __construct(string $tag = "span", string $content = "", string $id =null, array $cssClasses = null) {
        parent::__construct();
        $this->tag=$tag;
        $this->id = $id ?? "id" . self::$idNumber++;
        $this->content = $content;
        $this->cssClasses = $cssClasses ?? [];
        $this->updateTemplate();
    }
    public function getTag(){
        return $this->tag;
    }
    public function setTag(string $tag){
        $this->tag = $tag;
        $this->updateTemplate();
    }
    private function updateTemplate() {
        if(empty($this->cssClasses)) {
            $this->templateString = "<" . $this->tag . " id=\"" . $this->id . "\">" . 
            $this->marker . "</" . $this->tag . ">";    
        } else
        {
        $this->templateString = "<" . $this->tag . " id=\"" . $this->id . "\" class=\"" . $this->getCssClassString() . "\">" . 
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
        $classString = "";
        foreach ($this->cssClasses as $cssClass) {
            $classString .= $cssClass . " ";
        }
        return trim($classString);
    }
    public function removeCssClass(string $cssClass){
        $classKey = array_search($classString,$this->cssClasses);
        if ($classKey) {
            $this->cssClasses = array_splice($this->cssClasses,$classKey,1);
        }
    }
    public function addCssClass(string $cssClass){
        $classKey = array_search($classString,$this->cssClasses);
        if(!$classKey) {
            array_push($this->cssClasses,$cssClass);
        }
    }
    

}
