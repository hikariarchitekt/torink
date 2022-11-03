<?php
if(isset($_POST['addtask-submit'])){  
    require 'dbd.php';
    $place = $_POST['place'];
    $street = $_POST['street'];
    $number = $_POST['number'];
    $client = $_POST['client'];
    $phone = $_POST['phone'];
    $desc = $_POST['desc'];
    $area = $_POST['area'];
    $type = $_POST['type'];
    
    if (empty($place) || empty($number) || empty($client) || empty($phone) || empty($area) || empty($type)){
        header("Location: /../tasks/addtask.php?error=emptyform");
        exit();
    }
    
    else{
        $sql = "SELECT task_id FROM tasks WHERE task_id =?";
        $stmt = mysqli_stmt_init($conn);
        if(!mysqli_stmt_prepare($stmt, $sql)){
                   header("Location: /../tasks/addtask.php?error=sqlerror");
        exit(); 
        }
        else{
                $sql = "INSERT INTO tasks (area_id, place, street, place_number, client_name, client_phone, type_id, description, task_status_id) VALUES (?, ?, ?, ?, ?, ?, ?, ?, 1)";
                $stmt = mysqli_stmt_init($conn);
                    if(!mysqli_stmt_prepare($stmt, $sql)){
                        header("Location: /../tasks/addtask.php?error=sqlerror");
                        exit();
                    }
                    else{
                        mysqli_stmt_bind_param($stmt, "ississis",$area, $place, $street, $number, $client, $phone, $type, $desc);
                        mysqli_stmt_execute($stmt);
                        $tid=mysqli_insert_id($conn);
                        header("Location: /../tasks/addreq.php?id=$tid");
                        exit();
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
