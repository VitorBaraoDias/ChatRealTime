<?php
    session_start();
    include_once "config.php";
    $fname = mysqli_real_escape_string($conn, $_POST['fname']);
    $lname = mysqli_real_escape_string($conn, $_POST['lname']);
    $email = mysqli_real_escape_string($conn, $_POST['email']);
    $password = mysqli_real_escape_string($conn, $_POST['password']);

    if(!empty($fname) && !empty($lname) && !empty($email) && !empty($password)){

        //chech email valid
        if(filter_var($email, FILTER_VALIDATE_EMAIL)){
            $sql = mysqli_query($conn,"SELECT email FROM users WHERE email = '{$email}'");
            if(mysqli_num_rows($sql) > 0){
                echo "$email - This email already exists";
            }
            else {
                if(isset($_FILES['image'])){
                    //estudar
                    $img_name = $_FILES['image']['name']; //receber img name
                    $img_type = $_FILES['image']['type']; // receber tipo de img
                    $tmp_name = $_FILES['image']['tmp_name']; //nome temporario usado para salvar o ficheiro na pasta

                    $img_explode = explode('.',$img_name);
                    $img_ext = end($img_explode); //receber a extensao
                    
                    $extensions = ['png','jpeg','jpg']; //extensoes valida

                    if(in_array($img_ext,$extensions) === true){ //existensia da extensao
                        $time = time();
                        $new_img_name = $time.$img_name;

                        if(move_uploaded_file($tmp_name,"../img/".$new_img_name)){ //se img foi pra pasta com sucesso
                            $status = "Active now";
                            $random_id = rand(time(),10000000);
                             
                            //inserir
                            $sql2 = mysqli_query($conn,"INSERT INTO chat.users (unique_id,fname,lname,email,password,img,status)
                                                VALUES ($random_id, '$fname', '$lname', '$email', '$password', '$new_img_name', '$status')");
                            if($sql2) {
                                $sql3 = mysqli_query($conn,"SELECT * FROM users WHERE email = '{$email}'");
                                if(mysqli_num_rows($sql3) > 0){
                                    $row = mysqli_fetch_assoc($sql3);
                                    $_SESSION['unique_id'] = $row['unique_id']; // inicia sessao com id
                                    echo "Success";
                                }
                            }
                            else{
                                echo "Something went wrong".$random_id;
                            }
                        }
                       
                    }
                    else{
                        echo "Please select an image file - jpeg, jpg, png!";
                    }
                }
                else{
                    echo "Please select an Image file!";
                }
            }
        }
        else{
            echo "$email - This is not a valid email!";
        }
    }
    else{
        echo "All input fields are required!";
    }
?>