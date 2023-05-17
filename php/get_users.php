<?php 

    require_once("data.php");

    $req = "SELECT * FROM users";

    if($state = $conn->query($req)){
        if($state->num_rows == 1){
            $data = [
                "response"=>0,
                "message"=>"No users available"
            ];
            echo json_encode($data);

        }else{
            $data = [
                "response"=>1,
                "users"=>[]
        ];
            while($row = $state->fetch_array(MYSQLI_ASSOC)){
                $tmp = [];
                $tmp['mail'] = $row['mail'];
                $tmp['username'] = $row['username'];
                $tmp['img'] = $row['img'];
                $tmp['status'] = $row['status'];
                array_push($data['users'],$tmp);
            }
            echo json_encode($data);
        }
    }else{
        $data = [
            "response"=>"0",
            "message"=>"Problem get_users 1"
        ];
        echo json_encode($data);
    }

?>