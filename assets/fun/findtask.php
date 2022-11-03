<?php
if(isset($_POST['findtask-submit'])){  
    require 'dbd.php';
    $area = $_POST['area'];
    $task = $_POST['task'];
    $type = $_POST['type'];
    $place = $_POST['place'];
    $street = $_POST['street'];
    $streetnr = $_POST['streetnr'];
    $state = $_POST['state'];
    $data = $_POST['date'];
    $tech = $_POST['tech'];
    $dysp = $_POST['dysp'];



    
    if (empty($area) && empty($task) && empty($type) && empty($place) && empty($street) && empty($streetnr) && empty($state) && empty($data) && empty($tech) && empty($dysp)){
        header("Location: /../tasks/showtasks.php?msg=nocat");
        exit();
    }
  else {
	        header("Location: /../tasks/showtasks.php?all&area=$area&task=$task&type=$type&place=$place&street=$street&streetnr=$streetnr&state=$state&data=$data&tech=$tech&dysp=$dysp");
            exit(); 
    mysqli_stmt_close($stmt);
    mysqli_close($conn);
}
}
    else{
       header("Location: /../index.php");
       exit();
    }
