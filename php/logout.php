<?php 
    if($_SERVER['REQUEST_METHOD'] == "POST"){
        session_start();
        require_once("data.php");
        $username = $_SESSION["username"];
        $req = "UPDATE users SET status = 'offline' WHERE username = '$username'";

        $conn->query($req);

        $_SESSION = array();
        session_destroy();
        $data = ["response"=>1];
        echo json_encode($data);
    }else{
        header("location: ../login_page.php");
    }

?>