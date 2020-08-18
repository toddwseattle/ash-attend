<?php
class Menu 
{
    public $items;
    __constructor($items) {
        this->$items = $items;
    }
}

class MenuItem {
    public $description;
    public $help;
    public $link;
    public $id
    public $cssClasses = [];
    __constructor($description="Blank", $link="#", $help) {
        $this->$description = $description;
        $this->$link = $link;
        if (empty($help)) {
            $this->help = "Navigate to ". $description;
        } else {
            $this->help = $help;
        }
    }
    getHTML() {

    }
}