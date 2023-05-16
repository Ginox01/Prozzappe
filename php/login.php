<?php 
    if($_SERVER['REQUEST_METHOD']=="POST"){
        session_start();
        $token = $_POST['token'];
        if($_SESSION['crsf'] == $token){
            require_once("data.php");
            $mail = $conn->real_escape_string($_POST['mail']);
            $password = $conn->real_escape_string($_POST['password']);

            $req = "SELECT * FROM users WHERE mail='$mail'";

            if($state = $conn->query($req)){
                if($state->num_rows == 0){
                    $data = [
                        "response"=>0,
                        "message"=>"The mail doesn't match with any users"
                    ];
                    echo json_encode($data);
                }else{
                    $user = $state->fetch_array(MYSQLI_ASSOC);
                    if(password_verify($password,$user['password'])){
                        $_SESSION['logged'] = true;
                        $_SESSION['username'] = $user['username'];
                        $data = ["response"=>1];
                        echo json_encode($data);
                    }else{
                        $data = [
                            "response"=>0,
                            "message"=>"The password doesn't match"
                        ];
                        echo json_encode($data);
                    }
                }
            }else{
                $data = [
                    "response"=>0,
                    "message"=>"Error server 1, please try later"
                ];
                echo json_encode($data);
            }

        }else{
            $data = [
                "response"=>0,
                "messagge"=>"Accesses denied"
            ];
            echo json_encode($data);
        }
    }else{
        header("location: ../index.php");
    }

?>