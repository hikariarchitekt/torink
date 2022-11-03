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
        <h1 class="h1">Dodaj Wymagane</h1>
      </div>
      <?php
      if($myid==1 || $role_id==6){
       $tid = $_GET['id'];
       $req = DB::query('SELECT * FROM equipment');
       $ex = DB::query('SELECT name, task_id, required_task.equipment_id FROM equipment, required_task WHERE required_task.task_id=:TID AND equipment.equipment_id=required_task.equipment_id', array(':TID'=>$tid));   
       $task= DB::query('SELECT * FROM tasks, area, types, task_state WHERE tasks.type_id=types.type_id AND tasks.area_id=area.area_id AND tasks.task_status_id=task_state.task_state_id AND tasks.task_id=:TID', array(':TID'=>$tid)); 
      ?>
   
      <div class="col-md-7 col-lg-8">
        <div class="progress">
          <div class="progress-bar" role="progressbar" aria-label="Segment one - default example" style="width: 100%" aria-valuenow="100" aria-valuemin="0" aria-valuemax="100"></div>
          <div class="progress-bar progress-bar-striped progress-bar-animated bg-success" role="progressbar" aria-label="Segment two - animated striped success example" style="width: 100%" aria-valuenow="100" aria-valuemin="0" aria-valuemax="100"></div>
        </div>


        <?php foreach ($task as $t){  
            echo '<h1 class="h4"><div class="row mb-4 text-center"><div class="col-6 col-sm-4 themed-grid-col">Zlecenie nr: '.$t['task_id'].'</div><div class="col-6 col-sm-4 themed-grid-col">Strefa: '.$t['area_name'].'</div><div class="col-6 col-sm-4 themed-grid-col">Status: '.$t['task_state_name'].'</div></div></h1>';
            echo '<h1 class="h4"><div class="row mb-4 text-center"><div class="col-6 col-sm-4 themed-grid-col">'.$t['name'].'</div><div class="col-6 col-sm-4 themed-grid-col">'.$t['place'].' '.$t['street'].'  '.$t['place_number'].'</div><div class="col-6 col-sm-4 themed-grid-col">Klient: '.$t['client_name'].'</div></div></h1>';
          }

        
     ?>
          <div class="row g-3">
                      <div class="col-md-6">
              <label for="eq" class="form-label">Sprzęt:</label>
              <table class="table table-dark table-borderless">
              <tbody> 
              
            <?php  
            foreach ($ex as $e){  
                echo '<form  action="../assets/fun/deleteeqtask.php?id='.$e['task_id'].'&eq='.$e['equipment_id'].'" method="post">';
                echo '<tr><td>'.$e['name'].'</td>';
                echo '<td> <button type="submit"  class="btn btn-danger btn-sm" name="deletet-submit">X</button></td></tr></form>';
            }
            ?>
          
            </tbody>
              </table>

              <?php
              echo '<form class="needs-validation" action="../assets/fun/addeqtask.php?id='.$tid.'" method="post">'
              ?>

              <select class="form-select" name="eq">
                <option value="">Wybierz...</option>
                 <?php foreach ($req  as $r) {
                     echo '<option value='.$r['equipment_id'].'>'.$r['name'].'</option>';}?>
              </select>
            </div>
            
            <table>
             <td><button class="btn btn-primary btn-lg" type="submit" name="addeq-submit">Dodaj</button></form></td>
             <?php
              echo '<form class="needs-validation" action=" adddate.php?id='.$tid.'" method="post">'
              ?>
             <td><button class="btn btn-success btn-lg" type="submit" name="next-submit">Dalej</button></form></td>
                 </table>
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