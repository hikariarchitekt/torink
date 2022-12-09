<?php
    
if(isset($_POST['odpisz-submit'])){  
    require 'db.php';
    require 'dbd.php';
    $tid = $_POST['taskid'];
    $status = $_POST['sts'];
    $option = $_POST['option_select'];
    $opis = $_POST['opis'];
    $tech = $_POST['techid'];
    $yetin = DB::query('SELECT * FROM tech_task_dsc WHERE task_id=:tid;', array(':tid'=>$tid));
    
    if (empty($tid)){
        header("Location: /../tasks/tasks.php");
        exit();
    }
    elseif(!$yetin) {
            $nowD = date("Y-m-d").' '.date("H-i-s");
            DB::query('INSERT INTO tech_task_dsc (task_id, tech_id, task_status_id, status_option, task_desc) VALUES (:tid, :teid, :ts, :to, :td)', array(':tid'=>$tid, ':ts'=>$status, ':to'=>trim($option, "789_"), ':td'=>$opis, ':teid'=>$tech));
            DB::query('UPDATE tasks SET task_status_id=:ts, time_end="'.$nowD.'" WHERE task_id=:tid', array(':tid'=>$tid, ':ts'=>$status));
	        header("Location: /../tasks/task.php?id=$tid");
            exit(); 
    mysqli_stmt_close($stmt);
    mysqli_close($conn);
}
else {
	$nowD = date("Y-m-d").' '.date("H-i-s");
            DB::query('UPDATE tech_task_dsc SET task_id=:tid, tech_id=:teid, task_status_id=:ts, status_option=:to, task_desc=:td', array(':tid'=>$tid, ':ts'=>$status, ':to'=>trim($option, "789_"), ':td'=>$opis, ':teid'=>$tech));
            DB::query('UPDATE tasks SET task_status_id=:ts WHERE task_id=:tid', array(':tid'=>$tid, ':ts'=>$status));
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
