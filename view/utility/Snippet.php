<?php
interface iSnippet
{
    public function getHTML();
}
/**
 * Snippet class implements a way of doing html snippets with simple substitution.  put %MARKER% in $templateString
 * and getHTML will put $content where the marker is.  Constructor is $templateString,$content
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

