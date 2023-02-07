<?php
    while($row = mysqli_fetch_assoc($sql)){

        $sql2 = "SELECT * FROM messages WHERE (enviou_msg_id = {$outgoing_id} AND recebeu_msg_id = {$row['unique_id']})
        OR (enviou_msg_id = {$row['unique_id']} AND recebeu_msg_id = {$outgoing_id}) ORDER BY msg_id DESC";
        $query2 = mysqli_query($conn,$sql2);
        $row2 = mysqli_fetch_assoc($query2);
        if(mysqli_num_rows($query2) > 0){
            $result = $row2['msg'];
        }
        else{
            $result = "No messages found";
        }

        
    

        $msg = "";
        (strlen($result) > 28 ) ? $msg = substr($result, 0, 28).'...' : $msg = $result;
        ($row['status'] == "Offline now") ? $offline = "offline" : $offline = "";

        $outpot .= '<a href="../pagina/chat.php?user_id='.$row['unique_id'].'">
                        <div class="content">
                            <img src="../img/'.$row['img'].'" alt="">
                            <div class="details">
                                <span>'. $row['fname'] . " " . $row['lname'] .'</span>
                                <p>'. $msg.'</p>
                            </div>
                        </div> 
                        <div class="status-dot '.$offline.'"><i class="fas fa-circle"></i></div>
                     </a>';
    }
?>