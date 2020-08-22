<?php
class form_error
{
  public string $message;
  public string $fieldName;
  public int $status;
  public function __construct($message = "", $fieldName = "", $status = 0)
  {
    $this->message = $message;
    $this->fieldName = $fieldName;
    $this->status = $status;
  }
  public function is_ok()
  {
    return $this->status === 0;
  }
}
