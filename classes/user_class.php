<?php
include_once "form_error.php";
class user_class
{
  const NAME_FIELDS_REGEX = '/^[a-zA-Z]+$/';
  public string $fname;
  public string $lname;
  public string $email;
  public string $gender;
  /**3=student ser role: 1 faculty, 2 faculty intern and 3 student */
  public int $role = 3;
  /**1=active 2=inactive */
  public int $active = 1;
  public bool $valid = false;
  public function __construct(
    $fname = "",
    $lname = "",
    $email = "",
    $gender = "",
    $role = "3"
  ) {
    $this->fname = $fname;
    $this->lname = $lname;
    $this->email = $email;
    $this->gender = $gender;
    $this->role = $role;
    $messages = $this->createFromForm($fname, $lname, $email, $gender);
  }
  /** create a new user from a session
   * @param session  array map with user_first,user_last,user_email,user_gender,user_role
   */
  public static function create_from_session(array $session)
  {
    $from_session = new user_class();
    $from_session->createFromForm(
      $session["user_first"],
      $session["user_last"],
      $session["user_email"],
      $session["user_gender"]
    );
    $from_session->role = $session["user_role"];
    return $from_session;
  }
  public function __toString()
  {
    return $this->fname . " " . $this->lname . "(" . $this->email . ")";
  }
  public function getFullName()
  {
    return $this->fname . " " . $this->lname;
  }
  public function createFromForm($fname, $lname, $email, $gender)
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
        new form_error("Invalid First Name", "fname", 1)
      );
    }
    if (filter_var($lname, FILTER_VALIDATE_REGEXP, $nameValidate)) {
      $this->lname = $lname;
    } else {
      array_push(
        $resultMessages,
        new form_error("Invalid Last Name", "lname", 1)
      );
    }
    if (filter_var($email, FILTER_VALIDATE_EMAIL)) {
      $this->email = $email;
    } else {
      array_push($resultMessages, new form_error("Invalid Email", "email", 1));
    }
    if (
      filter_var($gender, FILTER_SANITIZE_STRING) and
      ($gender == "Male" or $gender == "Female")
    ) {
      $this->gender = $gender;
    } else {
      array_push(
        $resultMessages,
        new form_error("Invalid Gender", "gender", 1)
      );
    }
    if (count($resultMessages) == 0) {
      array_push($resultMessages, new form_error("All Fields Ok", "", 0));
      $this->valid = true;
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
