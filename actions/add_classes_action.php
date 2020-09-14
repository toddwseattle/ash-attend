<?php

class Class_Response {
    public $class_id;
    public $class_date;
    public $class_name;
}
$created_classes = [];
if(isset($_POST['new_classes'])){
$new_classes = $_POST['new_classes'];
foreach ($new_classes as $index => $value) {
    $create_class = new Class_Response();
    $create_class->class_date = $new_classes[$index]['class_date'];
    $create_class->class_name = $new_classes[$index]['class_name'];
    $create_class->class_id = $index;
    array_push($created_classes,$create_class);
}
echo json_encode(array("added" =>$created_classes));
}

?>