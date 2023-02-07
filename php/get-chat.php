<?php
    session_start();
    if(isset($_SESSION['unique_id'])){
        include_once "config.php";
        $my_id = mysqli_real_escape_string($conn, $_POST['my_id']); //enviou //outgoing
        $user_conversa_id = mysqli_real_escape_string($conn, $_POST['user_conversa_id']);  //recebeu  //incoming
        $message = mysqli_real_escape_string($conn, $_POST['message']);

        $output = "";

        $sql = "SELECT * FROM messages 
                LEFT JOIN users ON users.unique_id = messages.enviou_msg_id
                WHERE (enviou_msg_id = {$my_id} AND recebeu_msg_id = {$user_conversa_id})
                OR (enviou_msg_id = {$user_conversa_id} AND recebeu_msg_id = {$my_id}) ORDER BY msg_id";
        $query = mysqli_query($conn,$sql);
        if(mysqli_num_rows($query) > 0){
            while($row = mysqli_fetch_assoc($query)){
                if($row['enviou_msg_id'] == $my_id){ //se for este user que enviou
                   $output .= '<div class="chat outgoing">
                                    <div class="details">
                                        <p>'. $row['msg'] .'</p>
                                    </div>
                                </div>';
                }
                else{       //se este user recebeu
                     $output .= '<div class="chat incoming">
                                    <img src="../img/'. $row['img'] .'" alt="">
                                    <div class="details">
                                        <p>'. $row['msg'] .'</p>
                                    </div>
                                </div> ';
                }
            }
            echo $output;
        }
    }
    else{
        header('Location: ../pagina/login.php');
    }
?>