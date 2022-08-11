<?php
    $conn = mysqli_connect("Localhost", "root", "", "chat");

    if ($conn){
         echo mysqli_connect_error();
    }
?>