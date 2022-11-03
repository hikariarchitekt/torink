<?php
    
if(isset($_POST['status-submit'])){  
    require 'db.php';
    require 'dbd.php';
    $tid = $_GET['id'];
    $pracownik = $_GET['w'];
    $statetask = $_POST['status'];
    $workerrole = DB::query('SELECT * FROM users WHERE user_id=:usid;', array(':usid'=>$pracownik))[0]['role_id'];
    
    if (empty($tid) && empty($statetask)){
        header("Location: /../tasks/tasks.php");
        exit();
    }
    else {
            DB::query('UPDATE tasks SET task_status_id=:ts WHERE task_id=:tid', array(':tid'=>$tid, ':ts'=>$statetask));
            if($statetask==1){
                DB::query('UPDATE tasks SET dispatcher=NULL WHERE task_id=:tid', array(':tid'=>$tid));
            }
            elseif($statetask==2 && $workerrole==3){
                DB::query('UPDATE tasks SET dispatcher=:d WHERE task_id=:tid', array(':tid'=>$tid, ':d'=>$pracownik));
            }
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
