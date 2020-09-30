<?php
function sanitize_as_int($data) {
   $value=filter_var(trim($data),FILTER_SANITIZE_NUMBER_INT);
   return intval($value);
}
?>