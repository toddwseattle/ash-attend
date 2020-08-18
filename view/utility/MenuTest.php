<?php
use PHPUNIT\Framework\TestCase;
include_once "Menu.php";
include_once "MenuItem.php";
class MenuTest extends TestCase {
    public function testCanCreateInstanceOfMenu(){
        $testMenu=new Menu();
        $this->assertInstanceOf(Menu::class,$testMenu);
    }
    public function testCreatesDefaultContainerSnippet() {
        $testMenu = new Menu();
        $actual = $testMenu->containerSnippet->templateString;
    $this->assertEquals("<div class=\"menu\">%MARKER%</div>",$actual);
    }
    public function testDefaultInstanceReturnsEmptyDiv() {
        $testMenu = new Menu();
        $actualHTML= $testMenu->getHTML();
    $this->assertEquals("<div class=\"menu\"></div>",$actualHTML);
    }
    public function createAMenuWithItems($numItems=3) {
        $items = [];
        for ($i=0; $i < $numItems; $i++) { 
            $item = new MenuItem("Menu" . $i, "/menu" . $i);
            array_push($items,$item);
        }
        return new Menu($items);
    }
    public function testCreatesAMenuWith3Items() {
        $menu = $this->createAMenuWithItems(3);
    $this->assertEquals(3,count($menu->items));
    }
    public function testHTMLHasMenuTextOf3ItemMenu() {
        $testMenu= $this->createAMenuWithItems(3);
        $menuHTML = $testMenu->getHTML();
       # echo $menuHTML;
        $actual = true;
        for ($i=0; $i < 3; $i++) { 
            $actual = $actual and (strpos($menuHTML,"Menu" . $i)!=false);
        }
    $this->assertEquals(true,$actual);
    }
    public function testCanSetActiveMenuByDescription() {
        $testMenu = $this->createAMenuWithItems(3);
        $activeMI = $testMenu->items[0];
        $testMenu->setActiveMenu($activeMI->description);
    $this->assertTrue($testMenu->items[0]->active,$activeMI->description . " is Active");
    }
    public function testCanActivateAndDeactivateByDescription() {
        $testMenu = $this->createAMenuWithItems(3);
        $activeMI = $testMenu->items[0];
        $boolExp= $testMenu->items[0]->active;
        $newActiveMI = $testMenu->items[1];
        $testMenu->setActiveMenu($newActiveMI->description);
        $boolExp = $boolExp and !$testMenu->items[0]->active;
        $this->assertTrue($boolExp,"Activated/Deactivate Works");
    }
}