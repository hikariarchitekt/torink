<?php
    
if(isset($_POST['archive-submit'])){  
    require 'db.php';
    require 'dbd.php';
    $tid = $_POST['tid'];
    $table = DB::query('SELECT * FROM tasks WHERE task_id=:tid;', array(':tid'=>$tid));
    $odpis = DB::query('SELECT * FROM tech_task_dsc WHERE task_id=:tid;', array(':tid'=>$tid))[0]['task_desc'];
    $sopt = DB::query('SELECT * FROM tech_task_dsc WHERE task_id=:tid;', array(':tid'=>$tid))[0]['status_option'];
    $eq = DB::query('SELECT * FROM required_task, equipment WHERE task_id=:tid AND equipment.equipment_id=required_task.equipment_id;', array(':tid'=>$tid));
    if (empty($tid)){
        header("Location: /../tasks/tasks.php");
        exit();
    }
    else {  
            $eqlist = "";
            foreach ($eq as $e) {
                $eqlist.=$e['name']."\n";
            }
            foreach ($table as $t) {
                DB::query('INSERT INTO archive (task_id, area_id, place, street, place_number, client_name, client_phone, type_id, description, done_by, archived_by, time_set, time_start, time_end, end_status, status_option, end_desc, used_eq)
                                        VALUES (:tid, :area, :place, :street, :place_number, :client_name, :client_phone, :type_id ,:description, :done_by, :archived_by, :time_set, :time_start, :time_end, :end_status, :status_option, :end_desc, :used_eq)',
                                        array(':tid'=>$t['task_id'],
                                        ':area'=>$t['area_id'],
                                        ':place'=>$t['place'],
                                        ':street'=>$t['street'],
                                        ':place_number'=>$t['place_number'],
                                        ':client_name'=>$t['client_name'],
                                        ':client_phone'=>$t['client_phone'],
                                        ':type_id'=>$t['type_id'],
                                        ':description'=>$t['description'],
                                        ':done_by'=>$t['assigned_to'],
                                        ':archived_by'=>$t['dispatcher'],
                                        ':time_set'=>$t['time_set'],
                                        ':time_start'=>$t['time_start'],
                                        ':time_end'=>$t['time_end'],
                                        ':end_status'=>$t['task_status_id'],
                                        ':status_option'=>$sopt,
                                        ':end_desc'=>$odpis,
                                        ':used_eq'=>$eqlist));
            }
            
            DB::query('DELETE FROM tech_task_dsc WHERE task_id=:tid', array(':tid'=>$tid));
            DB::query('DELETE FROM required_task WHERE task_id=:tid', array(':tid'=>$tid));
            DB::query('DELETE FROM tasks WHERE task_id=:tid', array(':tid'=>$tid));
	        header("Location: /../tasks/archivetasks.php?id=$tid");
            exit(); 
    mysqli_stmt_close($stmt);
    mysqli_close($conn);
}

}
    else{
       header("Location: /../index.php");
       exit();
    }
