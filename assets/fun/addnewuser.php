<?php
if(isset($_POST['adduser-submit'])){  
    require 'dbd.php';
    $fname = $_POST['firstName'];
    $lname = $_POST['lastName'];
    $username = $_POST['username'];
    $password = $_POST['password'];
    $email = $_POST['email'];
    $phone = $_POST['phone'];
    $area = $_POST['area'];
    $role = $_POST['role'];
    $state = $_POST['state'];
    
    if (empty($fname) || empty($lname) || empty($username) || empty($password) || empty($email) || empty($phone) || empty($area) || empty($role) || empty($state)){
        header("Location: /../workers/addworker.php?error=emptyform");
        exit();
    }
    
    else{
        $sql = "SELECT user_name FROM users WHERE user_name=?";
        $stmt = mysqli_stmt_init($conn);
        if(!mysqli_stmt_prepare($stmt, $sql)){
                   header("Location: /../workers/addworker.php?error=sqlerror");
        exit(); 
        }
        else{
           mysqli_stmt_bind_param($stmt, "s",$username);
           mysqli_stmt_execute($stmt);
           mysqli_stmt_store_result($stmt);
           $resultCheck = mysqli_stmt_num_rows($stmt);
           if($resultCheck>0){
                header("Location: /../workers/addworker.php?error=nametaken");
                exit();
           }
           else{
                $sql = "INSERT INTO users (name, second_name, user_name, password, mail, phone, role_id, area_id, state_id) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?)";
                $stmt = mysqli_stmt_init($conn);
                    if(!mysqli_stmt_prepare($stmt, $sql)){
                        header("Location: /../workers/addworker.php?error=sqlerror");
                        exit();
                    }
                    else{
                        $hasedPwd = password_hash($password, PASSWORD_DEFAULT);
                        mysqli_stmt_bind_param($stmt, "sssssiiii",$fname, $lname, $username, $hasedPwd, $email, $phone, $role, $area, $state);
                        mysqli_stmt_execute($stmt);
                        header("Location: /../workers/addworker.php?operation=success");
                        exit();
                    }
           }
        }
    }
    mysqli_stmt_close($stmt);
    mysqli_close($conn);
}
    else{
       header("Location: /../index.php");
       exit();
    }
