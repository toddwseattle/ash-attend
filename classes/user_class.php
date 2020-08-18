<?php
include_once "FormError.php";
class user_class
{
  const NAME_FIELDS_REGEX = '/^[a-zA-Z]+$/';
  public string $fname;
  public string $lname;
  public string $email;
  /**3=student ser role: 1 faculty, 2 faculty intern and 3 student */
  public int $role = 3;
  /**1=active 2=inactive */
  public int $active = 1;
  public function __construct(
    $fname = "",
    $lname = "",
    $email = "",
    $role = "3"
  ) {
    $this->fname = $fname;
    $this->lname = $lname;
    $this->email = $email;
    $this->role = $role;
  }
  public function __toString()
  {
    return $this->fname . " " . $this->lname . "(" . $this->email . ")";
  }
  public function getFullName()
  {
    return $this->fname . " " . $this->lname;
  }
  public function createFromForm($fname, $lname, $email)
  {
    $resultMessages = [];
    $fname = trim(filter_var($fname, FILTER_SANITIZE_STRING));
    $lname = trim(filter_var($lname, FILTER_SANITIZE_STRING));
    $email = trim(filter_var($email, FILTER_SANITIZE_EMAIL));
    $nameValidate = ["options" => ["regexp" => self::NAME_FIELDS_REGEX]];
    $this->email = filter_var($email, FILTER_SANITIZE_EMAIL);
    if (filter_var($fname, FILTER_VALIDATE_REGEXP, $nameValidate)) {
      $this->fname = $fname;
    } else {
      array_push(
        $resultMessages,
        new FormError("Invalid First Name", "fname", 1)
      );
    }
    if (filter_var($lname, FILTER_VALIDATE_REGEXP, $nameValidate)) {
      $this->lname = $lname;
    } else {
      array_push(
        $resultMessages,
        new FormError("Invalid Last Name", "lname", 1)
      );
    }
    if (filter_var($email, FILTER_VALIDATE_EMAIL)) {
      $this->email = $email;
    } else {
      array_push($resultMessages, new FormError("Invalid Email", "email", 1));
    }
    if (count($resultMessages) == 0) {
      array_push($resultMessages, new FormError("All Fields Ok", "", 0));
    }
    return $resultMessages;
  }
  public function getRoleString()
  {
    switch ($this->role) {
      case 1:
        return "Faculty";
        break;
      case 2:
        return "Faculty Intern";
        break;
      case 3:
        return "Student";
      default:
        break;
    }
  }
}
