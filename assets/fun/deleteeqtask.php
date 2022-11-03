<?php
if(isset($_POST['deletet-submit'])){  
    require 'dbd.php';
    require 'db.php';
    $req= $_GET['eq'];
    $tid = $_GET['id'];
    
    if (empty($req)){
        header("Location: /../tasks/addeqtask.php?error=emptyform");
        exit();
    }
    
    else{
        $sql = "SELECT task_id FROM tasks WHERE task_id =?";
        $stmt = mysqli_stmt_init($conn);
        if(!mysqli_stmt_prepare($stmt, $sql)){
                   header("Location: /../tasks/addeqtask.php?error=sqlerror");
        exit(); 
        }
        else{
            DB::query('DELETE FROM required_task WHERE equipment_id=:idE AND task_id=:idT LIMIT 1', array(':idE'=>$req, ':idT'=>$tid));
            header("Location: /../tasks/addreq.php?id=$tid");
           }
        
    }
    mysqli_stmt_close($stmt);
    mysqli_close($conn);
}
    else{
       header("Location: /../index.php");
       exit();
    }
