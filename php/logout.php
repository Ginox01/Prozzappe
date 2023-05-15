<?php 
    if($_SERVER['REQUEST_METHOD'] == "POST"){
        session_start();
        $_SESSION = array();
        session_destroy();
        header("location ../login_page.php");
    }else{
        header("location: ../index.php");
    }

?>