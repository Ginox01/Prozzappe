<?php 
    if($_SERVER['REQUEST_METHOD'] == "POST"){
        require_once("data.php");
        $mittente = $_POST['mittente'];
        $destinatario = $_POST['destinatario'];
        $message = $conn->real_escape_string($_POST['message']);

        $req = "INSERT INTO messages(mittente,destinatario,message)
        VALUES('$mittente','$destinatario','$message')";

        if($conn->query($req)){
            $data = [
                "response"=>1,
                "message"=>$message,
                "mittente"=>$mittente,
                "destinatario"=>$destinatario
            ];
            echo json_encode($data);
        }else{
            $data = [
                "response"=>0,
                "message there are problemns in our server"
            ];
            echo json_encode($data);
        }

    }else{
        header("location: ../index.php");
    }

?>