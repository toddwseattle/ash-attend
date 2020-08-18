<?php
include_once "HTMLTag.php";
/** An HTML "a" tag derived from HTMLTag.  constructor takes a link, description, and id */
class LinkTag extends HTMLTag implements iHTMLTag
{   private $link="#";
    private $target="_self";
    private $description;
    const EMPTYLINK = "Empty Link";
    function __construct(string $link="#", $description=null, $id=null){
       if($link=="#" && !$description) {
           $description = self::EMPTYLINK;
       } elseif (!$description) {
           $description = $link;
       }
       $id = $id ?? "a" . strval(self::$idNumber++);
       parent::__construct("A",$description,$id);
       $this->description = $description;
       $this->link = $link;
       $this->updateTemplate();

    }
    protected function  updateTemplate() {
        # opening
        $this->templateString = "<" . $this->getTag() ." " . $this->attributeString("id",$this->id) . " " . 
        $this->attributeString("href",$this->link) . " " . $this->attributeString("target",$this->target) . " " . $this->attributeString("class",$this->getCssClassString()) . ">" ;
        # content
        $this->templateString .= $this->marker;
        $this->templateString .= "</" . $this->getTag() . ">";
    }
    /** get the private property $this->link */
    function getLink() {
        
        return $this->link;
    } 
    /**set the link property to @param $link */
    function setLink($link) {
        $this->link = $link;
        $this->updateTemplate();
    }
    function setDescription($description) {
        $this->description = $description;
        $this->updateTemplate();
    }
    function getDescription() {
        return $this->description;
    }

    
}
