<?php 
    if($_SERVER['REQUEST_METHOD'] == "POST"){
        require_once("data.php");

        $mittente = $_POST['mittente'];
        $destinatario = $_POST['destinatario'];

        $req = "SELECT * FROM messages WHERE (mittente = '$mittente' AND destinatario = '$destinatario')
         OR (mittente = '$destinatario' AND destinatario = '$mittente')";

         if($state = $conn->query($req)){
            if($state->num_rows == 0){
                $data = [
                    "response"=>2,
                    "message"=>"Send your welcome!"
                ];
                echo json_encode($data);
            }else{
                $data = [
                    "response"=>1,
                    "chat"=>[]
                ];
                while($chat = $state->fetch_array(MYSQLI_ASSOC)){
                    $tmp = [];
                    $tmp['id'] = $chat['id'];
                    $tmp['mittente'] = $chat['mittente'];
                    $tmp['destinatario'] = $chat['destinatario'];
                    $tmp['message'] = $chat['message'];
                    array_push($data["chat"],$tmp);
                }

                echo json_encode($data);
            }
         }else{
            $data = [
                "response"=>0,
                "message"=>"Error in the request, please try later"
            ];
            echo json_encode($data);
         }



    }else{
        header("location: ../index.php");
    }

?>