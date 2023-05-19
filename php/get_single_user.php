<?php 

    if($_SERVER['REQUEST_METHOD'] == "POST"){
        require_once("data.php");
        $username = $_POST['username'];

        $req = "SELECT * FROM users WHERE username='$username'";

        if($state = $conn->query($req)){
            if($state->num_rows == 0){
                $data = [
                    "response"=>0,
                    "message"=>"The page does not have loading correctly, please reload the page"
                ];
                echo json_encode($data);
            }else{
                $user = $state->fetch_array(MYSQLI_ASSOC);
                $data = [
                    "response"=>1,
                    "user"=>[
                        "username"=>$user['username'],
                        "img"=>$user['img'],
                        "status"=>$user['status']
                    ]
                ];
                echo json_encode($data);

            }
        }else{
            $data = [
                "response"=>0,
                "Sorry, we've problems in our server, please try later"
            ];
            echo json_encode($data);
        }

    }else{
        header("location: ../index.php");
    }

?>