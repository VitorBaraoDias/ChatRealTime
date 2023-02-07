<?php
    session_start();
    if(isset($_SESSION['unique_id'])){
        include_once "config.php";
        $my_id = mysqli_real_escape_string($conn, $_POST['my_id']);
        $user_conversa_id = mysqli_real_escape_string($conn, $_POST['user_conversa_id']);
        $message = mysqli_real_escape_string($conn, $_POST['message']);

        if(!empty($message)){
            $sql = mysqli_query($conn,"INSERT INTO messages (enviou_msg_id,recebeu_msg_id,msg)
                                VALUES ({$my_id},{$user_conversa_id},'{$message}')") or die();
        }
    }
    else{
        header('Location: ../pagina/login.php');
    }
?>