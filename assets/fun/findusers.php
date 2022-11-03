<?php
if(isset($_POST['finduser-submit'])){  
    require 'dbd.php';
    $fname = $_POST['firstName'];
    $lname = $_POST['lastName'];
    $area = $_POST['area'];
    $role = $_POST['role'];
    $state = $_POST['state'];
    
    if (empty($fname) && empty($lname) && empty($area) && empty($role) && empty($state)){
        header("Location: /../workers/showworkers.php?msg=nocat");
        exit();
    }
    else {
	        header("Location: /../workers/showworkers.php?all&userfname=$fname&userlname=$lname&area=$area&role=$role&state=$state");
            exit(); 
    mysqli_stmt_close($stmt);
    mysqli_close($conn);
}
}
    else{
       header("Location: /../index.php");
       exit();
    }
