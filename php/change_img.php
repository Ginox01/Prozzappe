<?php

    if($_SERVER['REQUEST_METHOD'] == "POST"){
        session_start();
        var_dump($_FILES);
        $name = $_FILES['image']['name'];
        $extention = explode(".",$name);
        $extention = end($extention);
        $valid_extentions = ["png","jpg"];
        if(in_array($extention,$valid_extentions)){
            $tmp_path = $_FILES['image']['tmp_name'];
            $newName = time().$name;
            $path = $_SERVER['DOCUMENT_ROOT']."/xx_prozzape/src/images/";
            move_uploaded_file($tmp_path,$path.$newName);

            require_once("data.php");
            $username = $_SESSION['username'];
            $req = "UPDATE users SET img = '$newName' WHERE username = '$username'";
            if($conn->query($req)){
                $_SESSION['err-img'] = "none";
                $_SESSION['img'] = $newName;
                header("location: ../index.php");
            }else{
                $_SESSION['err-img'] = "Error in our server, please try later";
                header("location: ../index.php");
            }
        }else{
            $_SESSION['err-img'] = "Invalid file, only png or jpg";
            header("location: ../index.php");
        }
    }else {
        header("location: ../index.php");
    }

?>