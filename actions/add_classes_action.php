<?php

//connnect to the controller
require("../controllers/attend_controller.php");

//check for post data
if(isset($_POST['new_classes']))
{  
    //variable to check if insert worked
    $insertresult;

    //get form data
    $new_classes = $_POST['new_classes'];

    //loop through class sessions
    foreach ($new_classes as $aclass) 
    {
        
        //get individual class session
        $get_class_name = $aclass['class_name'];
        $get_class_date = $aclass['class_date'];

        //testing code
        // echo("<script>console.log('PHP: " . $$get_class_name." " . $get_class_date. "');</script>");

        //add to database
        $add_item = insert_new_class_session_ctr($get_class_name, $get_class_date);

        if($add_item){
            //update variable
            $insertresult = "success";
        }else{
            //update variable
            $insertresult = "fail";
        }
    }

    //echo success or failure
    echo  $insertresult;
}
else
{
	echo "No post found";
}

?>