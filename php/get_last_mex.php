<?PHP 
    if($_SERVER['REQUEST_METHOD']=="POST"){
        require_once("data.php");
        $mittente = $_POST['mittente'];
        $destinatario = $_POST['destinatario'];

        $req = "SELECT * FROM messages WHERE 
        (mittente='$mittente'AND destinatario='$destinatario') OR (mittente='$destinatario'AND destinatario='$mittente')
        ORDER BY  id DESC LIMIT 1";

        if($state = $conn->query($req)){
            if($state->num_rows == 0){
                $data = [
                    "response"=>1,
                    "message"=>"No messages with this user"
                ];
                echo json_encode($data);
            }else{
                $msg = $state->fetch_array(MYSQLI_ASSOC);
                $data = [
                    "response"=>1,
                    "message"=>$msg['message']
                ];
                echo json_encode($data);
            }
        }else{
            $data = [
                "response"=>0,
                "message"=>"Loading.."
            ];
            echo json_encode($data);
        }

    }else{
        header("location: ../index.php");
    }

?>