<?php
  include '..\assets\fun\db.php';
  include '..\assets\fun\dbd.php';
  include '..\navbars\header.php';
  include '..\navbars\head.php';
  include '..\navbars\menu.php';
  $myid = $_SESSION['userId'];
   if(isset($_SESSION['userId'])){?>

    <title>Zlecenie</title>
  </body>
    <main class="col-md-9 ms-sm-auto col-lg-10 px-md-4">
      <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
        <h1 class="h1">Ustaw czas realizacji</h1>

      </div>
      <?php

      if($myid==1 || $role_id==6){
       $tid = $_GET['id'];
       $ex = DB::query('SELECT name, task_id, required_task.equipment_id FROM equipment, required_task WHERE required_task.task_id=:TID AND equipment.equipment_id=required_task.equipment_id', array(':TID'=>$tid));   
       $task= DB::query('SELECT * FROM tasks, area, types, task_state WHERE tasks.type_id=types.type_id AND tasks.area_id=area.area_id AND tasks.task_status_id=task_state.task_state_id AND tasks.task_id=:TID', array(':TID'=>$tid)); 
      ?>
   
<div class="col-md-7 col-lg-8">

        <div class="progress">
          <div class="progress-bar" role="progressbar" aria-label="Segment one - default example" style="width: 300%" aria-valuenow="300" aria-valuemin="0" aria-valuemax="100"></div>
          <div class="progress-bar progress-bar-striped progress-bar-animated bg-success" role="progressbar" aria-label="Segment two - animated striped success example" style="width: 100%" aria-valuenow="100" aria-valuemin="0" aria-valuemax="100"></div>
            </div>

        <?php foreach ($task as $t){  
            echo '<h1 class="h4"><div class="row mb-4 text-center"><div class="col-6 col-sm-4 themed-grid-col">Zlecenie nr: '.$t['task_id'].'</div><div class="col-6 col-sm-4 themed-grid-col">Strefa: '.$t['area_name'].'</div><div class="col-6 col-sm-4 themed-grid-col">Status: '.$t['task_state_name'].'</div></div></h1>';
            echo '<h1 class="h4"><div class="row mb-4 text-center"><div class="col-6 col-sm-4 themed-grid-col">'.$t['name'].'</div><div class="col-6 col-sm-4 themed-grid-col">'.$t['place'].' '.$t['street'].'  '.$t['place_number'].'</div><div class="col-6 col-sm-4 themed-grid-col">Klient: '.$t['client_name'].'</div></div></h1>';
          }

        echo '<br><form  action="adddate.php?id='.$tid.'" method="post">
        <h1 class="h4"><label for="start">Data: </label>
        <input type="date"  name="date" id ="date" class="form-control"
              value="'.date("Y-m-d").'"
              min="'.date("Y-m-d").'"> <button class="btn btn-primary btn-sm" type="submit" name="date-submit">Wybierz</button></form></h1>';


              if(isset($_POST['date-submit'])){ 
                $area=DB::query('SELECT area_id FROM tasks WHERE task_id=:TID',array(':TID'=>$tid))[0]['area_id'];
                $date= $_POST['date'];
                $edate= ''.$date.' 23:59:59';
                $sdate= ''.$date.' 00:00:00';

                $findtt = DB::query('SELECT type_id FROM tasks WHERE task_id=:TID',array(':TID'=>$tid))[0]['type_id'];
                
                if($findtt== 1 || $findtt == 2 || $findtt == 3){
                  $findhmN = DB::query('SELECT COUNT( * ) as "Nbr" FROM tasks WHERE type_id<=:Tid AND time_set BETWEEN :f1data AND :f2data AND area_id=:area ORDER BY time_set ASC LIMIT 3',array(':Tid'=>'3',':f1data'=>$sdate, ':f2data'=>$edate, ':area'=>$area))[0]['Nbr'];
                  $findhm = DB::query('SELECT * FROM tasks WHERE type_id<=:Tid AND time_set BETWEEN :f1data AND :f2data AND area_id=:area ORDER BY time_set ASC LIMIT 3',array(':Tid'=>'3',':f1data'=>$sdate, ':f2data'=>$edate,':area'=>$area));
                  echo '<h1 class="h4"> Sprawdź wolne terminy instalacji na '.$date.':</h1>
                  <table class="table table-dark table-borderless">
                  <tbody>';
                  $t8=0;
                  $t11=0;
                  $t14=0;
                  foreach($findhm as $h){
                    if($h['time_set']==$date.' 08:00:00') $t8=1;
                    elseif($h['time_set']==$date.' 11:00:00') $t11=1;
                    elseif($h['time_set']==$date.' 14:00:00') $t14=1;
                    echo '<tr><td>'.$h['task_id'].'</td>';
                    echo '<td>'.$h['time_set'].'</td>';
                    echo '<td> <button type="submit"  class="btn btn-danger btn-sm disabled" name="deletet-submit">Zajęte</button></td></tr>';
                  }

                  for ($i = $findhmN; $i < 4; $i++) {
                  
                    if($t8==0){
                      $t8=1;
                      echo '<tr><td><form  action="../assets/fun/adddatatask.php?id='.$tid.'&time='.$date.' 08:00:00'.'" method="post"> </td>';
                      echo '<td>'.$date.' 08:00:00'.'</td>';
                      
                      echo '<td> <button type="submit"  class="btn btn-success btn-sm" name="selectdate-submit">Wybierz</button></td><form></tr>';
                    }
                    elseif($t11==0){
                      $t10=1;
                      echo '<tr><td><form  action="../assets/fun/adddatatask.php?id='.$tid.'&time='.$date.' 11:00:00'.'" method="post"> </td>';
                      echo '<td>'.$date.' 11:00:00'.'</td>';
                      echo '<td> <button type="submit"  class="btn btn-success btn-sm" name="selectdate-submit">Wybierz</button></td><form></tr>';
                    } 
                    elseif($t14==0){
                      $t12=1;
                      echo '<tr><td> <form  action="../assets/fun/adddatatask.php?id='.$tid.'&time='.$date.' 14:00:00'.'" method="post"></td>';
                      echo '<td>'.$date.' 14:00:00'.'</td>';
                      echo '<td> <button type="submit"  class="btn btn-success btn-sm" name="selectdate-submit">Wybierz</button></td><form></tr>';
                    } 

                  }

                }
                elseif($findtt== 4 || $findtt == 5 || $findtt == 6){
                  $findhmN = DB::query('SELECT COUNT( * ) as "Nbr" FROM tasks WHERE time_set BETWEEN :f1data AND :f2data AND type_id>=:Tid AND area_id=:area ORDER BY time_set ASC LIMIT 4',array(':Tid'=>'4',':f1data'=>$sdate, ':f2data'=>$edate, ':area'=>$area))[0]['Nbr'];
                  $findhm = DB::query('SELECT * FROM tasks WHERE time_set BETWEEN :f1data AND :f2data AND type_id>=:Tid AND area_id=:area ORDER BY time_set ASC LIMIT 4',array(':Tid'=>'4',':f1data'=>$sdate, ':f2data'=>$edate,':area'=>$area));
                  echo '<h1 class="h4"> Sprawdź wolne terminy realizacji w dniu '.$date.':</h1>
                  <table class="table table-dark table-borderless">
                  <tbody>';

                $t8=0;
                $t10=0;
                $t12=0;
                $t14=0; 
                foreach($findhm as $h){
                  if($h['time_set']==$date.' 08:00:00') $t8=1;
                  elseif($h['time_set']==$date.' 10:00:00') $t10=1;
                  elseif($h['time_set']==$date.' 12:00:00') $t12=1;
                  elseif($h['time_set']==$date.' 14:00:00') $t14=1;
                  echo '<tr><td>'.$h['task_id'].'</td>';
                  echo '<td>'.$h['time_set'].'</td>';
                  echo '<td> <button type="submit"  class="btn btn-danger btn-sm disabled" name="deletet-submit">Zajęte</button></td></tr>';
                }
                for ($i = $findhmN; $i < 4; $i++) {
                  
                  if($t8==0){
                    $t8=1;
                    echo '<tr><td><form  action="../assets/fun/adddatatask.php?id='.$tid.'&time='.$date.' 08:00:00'.'" method="post"> </td>';
                    echo '<td>'.$date.' 08:00:00'.'</td>';
                    
                    echo '<td> <button type="submit"  class="btn btn-success btn-sm" name="selectdate-submit">Wybierz</button></td><form></tr>';
                  }
                  elseif($t10==0){
                    $t10=1;
                    echo '<tr><td><form  action="../assets/fun/adddatatask.php?id='.$tid.'&time='.$date.' 10:00:00'.'" method="post"> </td>';
                    echo '<td>'.$date.' 10:00:00'.'</td>';
                    echo '<td> <button type="submit"  class="btn btn-success btn-sm" name="selectdate-submit">Wybierz</button></td><form></tr>';
                  } 
                  elseif($t12==0){
                    $t12=1;
                    echo '<tr><td> <form  action="../assets/fun/adddatatask.php?id='.$tid.'&time='.$date.' 12:00:00'.'" method="post"></td>';
                    echo '<td>'.$date.' 12:00:00'.'</td>';
                    echo '<td> <button type="submit"  class="btn btn-success btn-sm" name="selectdate-submit">Wybierz</button></td><form></tr>';
                  } 
                  elseif($t14==0){
                    $t14=1;
                    echo '<tr><td><form  action="../assets/fun/adddatatask.php?id='.$tid.'&time='.$date.' 14:00:00'.'" method="post"> </td>';
                    echo '<td>'.$date.' 14:00:00'.'</td>';
                    echo '<td> <button type="submit"  class="btn btn-success btn-sm" name="selectdate-submit">Wybierz</button></td><form></tr>';
                  } 
                
                
                
              }
              }
              }



     ?>

              
            


   <?php
               if(isset($_GET['error'])){
                if($_GET['error']=="exist"){
                    echo "<center><h4 style='color:red'>Już dodano!</h4></center>";
                }
                else if($_GET['error']=="sqlerror"){
                    echo "<center><h4 style='color:red'>Nieznay błąd!</h4></center>";
                }
            }
      }
      else {
	echo "<h1 style='color:red'>Brak dostępu!</h1>";
}

   ?>
      </div>
    </main>
  </div>
</div>
     

    <script src="../assets/dist/js/bootstrap.bundle.min.js"></script>
      <script src="https://cdn.jsdelivr.net/npm/feather-icons@4.28.0/dist/feather.min.js" integrity="sha384-uO3SXW5IuS1ZpFPKugNNWqTZRRglnUJK6UAZ/gxOX80nxEkN9NcGZTftn6RzhGWE" crossorigin="anonymous"></script><script src="https://cdn.jsdelivr.net/npm/chart.js@2.9.4/dist/Chart.min.js" integrity="sha384-zNy6FEbO50N+Cg5wap8IKA4M/ZnLJgzc6w2NqACZaK0u0FXfOWRRJOnQtpZun8ha" crossorigin="anonymous"></script><script src="..\navbars\dashboard.js"></script>
  </body>
</html>
    
<?php
   }?>