<?php
  session_start();
  if(!isset($_SESSION['unique_id'])){
      header('Location: login.php');
  }
?>
<?php 
    include_once "header.php";
?>
<body>
    <div class="container">
        <section class="chat-area">
            <header>
                <?php
                    include_once "../php/config.php";
                    $userConversa_id = mysqli_real_escape_string($conn, $_GET['user_id']);
                    $sql = mysqli_query($conn, "SELECT * FROM users WHERE unique_id = {$userConversa_id}");
                    if(mysqli_num_rows($sql) > 0){
                        $row = mysqli_fetch_assoc($sql);
                    }
                    else{
                        header('Location: users.php');
                    }
                ?>
                <a href="users.php" class="back-icon"><i class="fas fa-arrow-left"></i></a>
                <img src="../img/<?php echo $row['img']?>" alt="">
                <div class="details">
                    <span>
                        <?php echo $row['fname'] . ' ' . $row['lname']?>
                    </span>
                    <p>
                        <?php echo $row['status']?>
                    </p>
                </div>
            </header>
            <div class="chat-box">      
            </div>
            <form action="#" class="typing-area" autocomplete="off">
                <input type="text" name="my_id" value="<?php echo $_SESSION['unique_id']?>" hidden>
                <input type="text" name="user_conversa_id"value="<?php echo $userConversa_id?>" hidden>
                <input type="text" name="message" class="input-field" placeholder="Type a message here...">      
                <button><i class="fa-solid fa-paper-plane"></i></button>
            </form>
        </section>
    </div>
    <script src="../javascript/chat.js"></script>
</body>
</html> 