<?php 
    if($_SERVER['REQUEST_METHOD'] == "POST"){
        session_start();
        $_SESSION = array();
        session_destroy();
        $data = ["response"=>1];
        echo json_encode($data);
    }else{
        header("location: ../index.php");
    }

?>