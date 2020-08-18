<?php
use PHPUNIT\Framework\TestCase;
include_once "LinkTag.php";
class LinkTagTest extends TestCase {
    public function testCanCreateInstanceOfLinkTag(){
        $testLinkTag=new LinkTag();
        $this->assertInstanceOf(LinkTag::class,$testLinkTag);
    }
    public function testDefaultsToEmptyLink() {
        $tl = new LinkTag();
    $this->assertEquals("#", $tl->getLink());
    }
    public function testDefaultsToEmptyLinkDescription() {
        $tl = new LinkTag();
    $this->assertEquals(LinkTag::EMPTYLINK,$tl->getDescription());
    }
    public function testGeneratesCorrectDefaultHTML() {
        $tl = new LinkTag();
        $tl->setId("alink");
        $defaultTagHtml= "<A id=\"alink\" href=\"#\"" . " target=\"_self\""." >". LinkTag::EMPTYLINK . "</A>" ;
    $this->assertEquals($tl->getHTML(),$defaultTagHtml);
    }

}