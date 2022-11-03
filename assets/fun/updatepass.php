<?php
session_start();
if(isset($_POST['passupdate-submit'])){  
    require 'dbd.php';
    require 'db.php';
    $myid = $_SESSION['userId'];
    $newpass = $_POST['newpass'];
    $newpass2 = $_POST['newpass2'];
    $oldpass = $_POST['oldpass'];
    $userid= $_GET['id'];

    
    if (empty($newpass) || empty($newpass2) || empty($myid)|| empty($oldpass)){
        header("Location: /../workers/settings.php?error=emptyform");
        exit();
    }
    elseif ($newpass!=$newpass2){
        header("Location: /../workers/settings.php?error=notsame");
        exit();
    }
    
    else{
        $currentPwd = DB::query('SELECT password FROM users WHERE user_id=:usid', array(':usid'=>$myid))[0]['password'];
        $hasedNewPwd = password_hash($newpass, PASSWORD_DEFAULT);
        $verify = password_verify($oldpass, $currentPwd);
        if($verify){
        DB::query('UPDATE users SET password=:nhp WHERE user_id=:usid', array(':usid'=>$myid, ':nhp'=>$hasedNewPwd));
        header("Location: /../workers/settings.php?operation=success");
        exit();
        }
        else{
         header("Location: /../workers/settings.php?error=wrongpass");
         exit();  
        }
     }
    }

    else{
       header("Location: /../index.php");
       exit();
    }
