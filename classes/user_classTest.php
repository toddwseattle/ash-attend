<?php
use PHPUNIT\Framework\TestCase;
include_once "user_class.php";
class user_classTest extends TestCase
{
  public function testCanCreateInstanceOfUser_class()
  {
    $test_user_class = new user_class();
    $this->assertInstanceOf(user_class::class, $test_user_class);
  }
  public function testCan_Create_User_With_all_props()
  {
    $test_user = new user_class("First", "Last", "firstlast@ashesi.edu.gh");
    ($trueDat =
      ($test_user->fname == "First" and $test_user->lname == "Last")) and
      $test_user->email == "firstlast@ashesi.edu.gh";
    $this->assertTrue($trueDat, "Can_Create_User_With_all_props $trueDat");
  }
  public function testNew_User_Is_Student_by_Default()
  {
    $tu = new user_class("First", "Last", "firstlast@ashesi.edu.gh");
    $this->assertEquals(3, $tu->role);
  }
  public function testUser_FromFormAddsFname()
  {
    $tu = new user_class();
    $tu->createFromForm("Todd", "Warren", "twarren@ashesi.edu.gh");
    $actual = $tu->fname;
    $this->assertEquals("Todd", $actual);
  }

  public function testUser_FromFormAddsLname()
  {
    $tu = new user_class();
    $tu->createFromForm("Todd", "Warren", "twarren@ashesi.edu.gh");
    $actual = $tu->lname;
    $this->assertEquals("Warren", $actual);
  }
  public function testUser_FromFormAddsEmail()
  {
    $tu = new user_class();
    $tu->createFromForm("Todd", "Warren", "twarren@ashesi.edu.gh");
    $actual = $tu->email;
    $this->assertEquals("twarren@ashesi.edu.gh", $actual);
  }
  public function testUser_FromFormAddsNoErr()
  {
    $tu = new user_class();
    $tu->createFromForm("Todd", "Warren", "twarren@ashesi.edu.gh");
    $actual = $tu->createFromForm("Todd", "Warren", "twarren@ashesi.edu.gh")[0]
      ->status;

    $this->assertEquals(0, $actual);
  }
  public function testUser_From_Form_Err_On_BadFName()
  {
    $tu = new user_class();
    $result = $tu->createFromForm("Todd3", "Warren", "twarren@ashesi.edu.gh");
    $actual = $result[0]->fieldName;
    $this->assertEquals("fname", $actual);
  }
  public function testUser_From_Form_Err_On_BadLName()
  {
    $tu = new user_class();
    $result = $tu->createFromForm("Todd", "3Warren", "twarren@ashesi.edu.gh");
    $actual = $result[0]->fieldName;
    $this->assertEquals("lname", $actual);
  }
  public function testUser_From_Form_Err_On_Bad_Email()
  {
    $tu = new user_class();
    $result = $tu->createFromForm("Todd", "Warren", "twarrenashesi.edu.gh");
    $actual = $result[0]->fieldName;
    $this->assertEquals("email", $actual);
  }
}
