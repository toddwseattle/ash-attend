<?php
include_once "Snippet.php";
include_once "HTMLTag.php";
include_once "LinkTag.php";
/**
 * A MenuItem  pass $description, $link, $help and $id to the constructor.  by default
 * produces href="$link" id="$id" $descriptions .  $help is not yet used.
 */
class MenuItem implements iSnippet {
    public $description;
    public $help;
    public $link;
    public bool $enabled = true;
    public bool $active = false;
    public ?LinkTag $tag;
    function __construct($description="Blank", $link="#", $help=null, $id=null) {
        $this->description = $description;
        $this->link = $link;
        $firstWord = explode(' ', trim($description))[0];
        $id = $id ?? 'mi-' . $firstWord ;
        if (empty($help)) {
            $this->help = "Navigate to ". $description;
        } else {
            $this->help = $help;
        }
        $this->tag = new LinkTag($link,$description, $id);
        $this->tag->addCssClass('menu-item');
    }
    function getHTML() {
        $this->updateHTMLTag();
        return $this->tag->getHTML();
    }
    function updateHTMLTag() {
        if(!$this->tag) {
            $this->tag = new LinkTag($description, $id);
            $this->tag->addCssClass('menu-item');
            
        } else {
            $this->tag->setDescription($this->description);
            $this->tag->setLink($this->link);
        }
       
    }
}