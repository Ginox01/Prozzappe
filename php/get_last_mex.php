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
                (strlen($msg["message"]) > 20 ) ? $mex = substr($msg["message"],0,20) : $mex = $msg["message"];
                $data = [
                    "response"=>1,
                    "message"=>$mex
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