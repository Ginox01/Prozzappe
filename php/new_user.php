<?php 
    if($_SERVER['REQUEST_METHOD'] == "POST"){
        session_start();
        $token = $_POST['token'];
        if($token == $_SESSION['crsf']){
            require_once("data.php");
            $username = $conn->real_escape_string($_POST['username']);
            $mail = $conn->real_escape_string($_POST['mail']);
            $psw = $conn->real_escape_string($_POST['password']);
            

            if(!filter_var($mail,FILTER_VALIDATE_EMAIL)){
                $data = [
                    "response"=>0,
                    "message"=>"invalid mail"
                ];
                echo json_encode($data);
            }else{
                $has_psw = password_hash($psw,PASSWORD_DEFAULT);
                $req = "SELECT * FROM users WHERE username='$username'";

                if($state = $conn->query($req)){
                    if($state->num_rows == 0){
                        //qui++++++++++++++++++++++ creare inserimetno
                    }else{
                        $data = [
                            "response"=>0,
                            "message"=>"This user is alredy taken"
                        ];
                        echo json_encode($data);
                    }
                }else{
                    $data = [
                        "response"=>0,
                        "message"=>"Problem request"
                    ];
                    echo json_encode($data);
                }

                $req = "INSERT INTO users(mail,username,password)
                VALUES('$mail','$username','$psw')";



                if($conn->query($req)){
                    $_SESSION['logged'] = true;
                    $_SESSION
                }else{
                    $data = [
                        "response"=>0,
                        "message"=>"Problem in our server, try later"
                    ];
                    echo json_encode($data);
                }
            }
        }
    }else {
        header("location: ../index.php");
    }

?>