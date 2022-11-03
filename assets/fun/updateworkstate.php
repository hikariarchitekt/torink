<?php
if(isset($_POST['stateupdate-submit'])){  
    require 'db.php';
    require 'dbd.php';
    $myid = $_POST['myid'];
    $start = $_POST['start'];
    $stop = $_POST['stop'];
   
    if (empty($myid)){
        header("Location: /../dashboard/index.php");
        exit();
    }
    else {
            if(empty($stop)){
                DB::query('UPDATE users SET state_id=3 WHERE user_id=:tid', array(':tid'=>$myid));
                header("Location: /../dashboard/index.php");
                exit(); 
            }
            elseif(empty($start)){
                DB::query('UPDATE users SET state_id=4 WHERE user_id=:tid', array(':tid'=>$myid));
                header("Location: /../dashboard/index.php");
                exit(); 
            }
    }
    }
        else{
        header("Location: /../index.php");
        exit();
        }
