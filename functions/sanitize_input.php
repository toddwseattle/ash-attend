<?php
/**
 * make sure a string is trimmed and sanitized from a form. 
 * @param $data string to sanitize as input
 * @return integer version of sanitized value
 */
function sanitize_as_int($data) {
   $value=filter_var(trim($data),FILTER_SANITIZE_NUMBER_INT);
   return intval($value);
}
?>