<?php
    session_start();
    include_once "config.php";
    $outgoing_id = $_SESSION['unique_id'];
    $sql = mysqli_query($conn,"SELECT * from users WHERE NOT unique_id = {$outgoing_id}");
  
    $outpot = "";
    if(mysqli_num_rows($sql) == 1){
        $outpot .= "No users are available";
    }
    else if (mysqli_num_rows($sql) > 0){ 
        include "data.php";
    }
    echo $outpot;
?>