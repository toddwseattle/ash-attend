<?php
use PHPUNIT\Framework\TestCase;
include_once "MenuItem.php";
class MenuItemTest extends TestCase {
    public function testEmptyConstructorWorks() {
        $mu = new MenuItem();
        $this->AssertInstanceOf(MenuItem::class,$mu);
    }
    public function testEmptyConstructorNotNull() {
        $mu = new MenuItem();
        $this->AssertNotNull($mu);
    }
    public function testEmptyConstructorDefaultLinkIsOk() {
        $mu = new MenuItem('Blank','#');
        $this->AssertEquals("#",$mu->link);
    }
    public function testEmptyConstructorDefaultDescriptionIsBlank() {
        $mu = new MenuItem();
        $this->AssertEquals("Blank",$mu->description);
    }
    public function testItShouldHaveAnHtmlTagMemberByDefault() {
        $mu = new MenuItem();
    $this->AssertEquals($mu->tag->getTag(),"A");
    }
    public function testItShouldHaveADefaultIdOfMiBlank() {
        $mu = new MenuItem();
    $this->AssertEquals($mu->tag->getId(),"mi-Blank");
    }
    public function testItShouldHaveDefaultHelpText() {
        $mu = new MenuItem();
    $this->AssertEquals($mu->help,"Navigate to " . "Blank");
    }
    public function testShouldCreateDefaultItemHtml() {
        $actual=(new MenuItem())->getHTML();
        $expected = <<<_EXPECT
<A id="mi-Blank" href="#" target="_self" class="menu-item">Blank</A>
_EXPECT;
    $this->assertEquals($expected,$actual);
    }
}