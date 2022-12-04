<?php
if(isset($_POST['selectdate-submit'])){  
    require 'dbd.php';
    require 'db.php';
    $time= $_GET['time'];
    $tid = $_GET['id'];
    
    if (empty($time)){
        header("Location: /../tasks/addate.php?error=emptyform");
        exit();
    }

    else{
        $sql = "SELECT time_set FROM tasks WHERE time_set=?";
        $stmt = mysqli_stmt_init($conn);
        if(!mysqli_stmt_prepare($stmt, $sql)){
                   header("Location: /../tasks/addate.php?error=sqlerror");
        exit(); 
        }
        else{
            DB::query('UPDATE tasks SET time_set=:dt WHERE task_id=:id', array(':id'=>$tid, ':dt'=>$time));
            header("Location: /../tasks/tasksaddedsuccessfully.php");
           }
        
    }
    mysqli_stmt_close($stmt);
    mysqli_close($conn);
}
    elseif(isset($_POST['updatedate-submit'])){  
        require 'dbd.php';
        require 'db.php';
        $time= $_GET['time'];
        $tid = $_GET['id'];
    
        if (empty($time)){
            header("Location: /../tasks/update.php?error=emptyform");
            exit();
        }

        else{
            $sql = "SELECT time_set FROM tasks WHERE time_set=?";
            $stmt = mysqli_stmt_init($conn);
            if(!mysqli_stmt_prepare($stmt, $sql)){
                       header("Location: /../tasks/addate.php?error=sqlerror");
            exit(); 
            }
            else{
                DB::query('UPDATE tasks SET time_set=:dt WHERE task_id=:id', array(':id'=>$tid, ':dt'=>$time));
                header("Location: /../tasks/task.php?id=$tid");
               }
        
        }
        mysqli_stmt_close($stmt);
        mysqli_close($conn);







    }
    else{
       header("Location: /../index.php");
       exit();
    }
