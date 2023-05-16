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
                        $req = "SELECT * FROM users WHERE mail='$mail'";
                        if($state = $conn->query($req)){
                            if($state->num_rows == 0){

                                $img = "default";
                                $status = "online";

                                $req = "INSERT INTO users(mail,username,password,img,status)
                                VALUES('$mail','$username','$has_psw','$img','$status')";
            
                                if($conn->query($req)){
                                    $_SESSION['logged'] = true;
                                    $_SESSION['username'] = $username;
                                    $data = [
                                        "response"=>1,
                                    ];
                                    echo json_encode($data);
                                }else{
                                    $data = [
                                        "response"=>0,
                                        "message"=>"Problem with last request"
                                    ];
                                    echo json_encode($data);
                                }

                            }else{
                                $data = [
                                    "response"=>0,
                                    "message"=>"This mail is alredy in use"
                                ];
                                echo json_encode($data);
                            }
                        }else{
                            $data = [
                                "response"=>0,
                                "message"=>"Problem request 2"
                            ];
                            echo json_encode($data);
                        }
                    }else{
                        $data = [
                            "response"=>0,
                            "message"=>"This username is alredy taken"
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

            }
        }
    }else {
        header("location: ../index.php");
    }

?>