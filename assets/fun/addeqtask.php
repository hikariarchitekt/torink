<?php
if(isset($_POST['addeq-submit'])){  
    require 'dbd.php';
    require 'db.php';
    $req= $_POST['eq'];
    $tid = $_GET['id'];
    
    if (empty($req)){
        header("Location: /../tasks/addeqtask.php?error=emptyform");
        exit();
    }

    else{
        $sql = "SELECT equipment_id, task_id FROM required_task WHERE equipment_id=? AND task_id=?";
        $stmt = mysqli_stmt_init($conn);
        if(!mysqli_stmt_prepare($stmt, $sql)){
                   header("Location: /../tasks/addeqtask.php?error=sqlerror");
        exit(); 
        }
        else{
            $sql = "INSERT INTO required_task (task_id, equipment_id) VALUES (?, ?)";
                $stmt = mysqli_stmt_init($conn);
                    if(!mysqli_stmt_prepare($stmt, $sql)){
                        header("Location: /../tasks/addreq.php??error=sqlerror");
                        exit();
                    }
                    else{
                        mysqli_stmt_bind_param($stmt, "ii",$tid, $req);
                        mysqli_stmt_execute($stmt);
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
