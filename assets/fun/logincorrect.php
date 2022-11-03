<?php
if(isset($_POST['login-submit'])){
    require 'dbd.php';
    require 'db.php';

    $user = $_POST['name'];
    $password = $_POST['pwd'];
    
    if (empty($user) || empty($password)){
       header("Location: /../index.php?error=emptyfileds");
       exit(); 
    }
    else{
       $sql = "SELECT * FROM users WHERE user_name=?;";
       $stmt = mysqli_stmt_init($conn);
       if(!mysqli_stmt_prepare($stmt, $sql)){
       header("Location: /../index.php?error=sqlerror");
       exit(); 
    }
       else{
        mysqli_stmt_bind_param($stmt, "s",$user);
        mysqli_stmt_execute($stmt);
        $result = mysqli_stmt_get_result($stmt);
        if($row = mysqli_fetch_assoc($result)){
            $pwdCheck = password_verify($password, $row['password']);
                if($pwdCheck == false){
                   header("Location: /../index.php?error=wrongpass");
                   exit();  
                }
                elseif($pwdCheck == true){
                    session_start();
                    $_SESSION['userId'] = $row['user_id'];
                    $_SESSION['username'] = $row['name'];
                    $_SESSION['user2name'] = $row['second_name'];
                    $_SESSION['role'] = $row['role_id'];
                    $_SESSION['id_area'] = $row['area_id'];
                    header("Location: /../index.php?operation=success");
                    exit();  
                }

        }
        else{
            header("Location: /../index.php?error=nouser");
            exit();  
        }
       }       
} 
}

else{
       header("Location: /../login.php");
       exit();
}
