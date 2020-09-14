<?php
if(isset($_POST['new_classes'])){
$new_classes = $_POST['new_classes'];
}
echo json_encode($new_classes);
?>