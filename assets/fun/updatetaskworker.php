<?php
if(isset($_POST['worker-submit'])){  
    require 'db.php';
    require 'dbd.php';
    $tid = $_POST['taskid'];
    $pracownik = $_POST['tech'];
    if (empty($tid) && empty($pracownik)){
        header("Location: /../tasks/tasks.php?ERROR=nodata");
        exit();
    }
    else {
            DB::query('UPDATE tasks SET assigned_to=:worker, task_status_id=3 WHERE task_id=:tid', array(':tid'=>$tid, ':worker'=>$pracownik));
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
