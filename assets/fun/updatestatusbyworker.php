<?php
    require 'db.php';
    require 'dbd.php';
    if(isset($_POST['start-submit'])){  

        $tid = $_POST['tid'];
        $status = $_POST['status'];
    
        if (empty($tid) && empty($status)){
            header("Location: /../tasks/tasks.php?nodata");
            exit();
        }
        else {
                DB::query('UPDATE tasks SET task_status_id=:ts WHERE task_id=:tid', array(':tid'=>$tid, ':ts'=>$status));
	            header("Location: /../tasks/task.php?id=$tid");
                exit(); 
        mysqli_stmt_close($stmt);
        mysqli_close($conn);
    }
    }
    elseif(isset($_POST['onmyway-submit'])){  

        $tid = $_POST['tid'];
        $status = $_POST['status'];
    
        if (empty($tid) && empty($status)){
            header("Location: /../tasks/tasks.php?nodata");
            exit();
        }
        else {
                DB::query('UPDATE tasks SET task_status_id=:ts WHERE task_id=:tid', array(':tid'=>$tid, ':ts'=>$status));
	            header("Location: /../tasks/task.php?id=$tid");
                exit(); 
        mysqli_stmt_close($stmt);
        mysqli_close($conn);
    }
    }
        elseif(isset($_POST['install-submit'])){  

        $tid = $_POST['tid'];
        $status = $_POST['status'];
    
        if (empty($tid) && empty($status)){
            header("Location: /../tasks/tasks.php?nodata");
            exit();
        }
        else {  
                $nowD = date("Y-m-d").' '.date("H-i-s");
                DB::query('UPDATE tasks SET task_status_id=:ts, time_start="'.$nowD.'" WHERE task_id=:tid', array(':tid'=>$tid, ':ts'=>$status));
	            header("Location: /../tasks/task.php?id=$tid");
                exit(); 
        mysqli_stmt_close($stmt);
        mysqli_close($conn);
    }
    }
        else{
           header("Location: /../index.php");
           exit();
        }
