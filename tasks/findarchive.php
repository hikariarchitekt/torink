<?php
  include '..\assets\fun\db.php';
  include '..\assets\fun\dbd.php';
  include '..\navbars\header.php';
  include '..\navbars\head.php';
  include '..\navbars\menu.php';
  $myid = $_SESSION['userId'];
   if(isset($_SESSION['userId'])){
   $areas = DB::query('SELECT * FROM area');    
   $states = DB::query('SELECT * FROM task_state');
   $type = DB::query('SELECT * FROM types'); 
   $technik = DB::query('SELECT * FROM users WHERE role_id=5'); 
   $dyspozytor = DB::query('SELECT * FROM users WHERE role_id=3'); 
   ?>

    <title>Wyszukaj Zarchiwizowane Zlecenia</title>
  </body>
    <main class="col-md-9 ms-sm-auto col-lg-10 px-md-4">
      <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
        <h1 class="h1">Wyszukaj Zarchiwizowane Zlecenia</h1>
        
      </div>
   <h1 class="h4">Krytera:</h1>
<div class="col-md-7 col-lg-8">
        <form class="needs-validation" action="..\assets\fun\findarchivedtask.php" method="post">
          <div class="row g-3">
            <div class="col-md-2">
              <label for="country" class="form-label">Rejon</label>
              <select class="form-select" name="area" >
                <option value="">Wybierz...</option>
                 <?php foreach ($areas as $a) {
                     echo '<option value='.$a['area_id'].'>'.$a['area_name'].'</option>';}?>
              </select>
            </div>
			
			<div class="col-sm-2">
              <label for="task" class="form-label">Numer Zlecenia</label>
              <input type="text" class="form-control" name="task" placeholder="" value="" minlength="1">
            </div>
			
			 <div class="col-md-2">
              <label for="type" class="form-label">Typ</label>
              <select class="form-select" name="type" >
                <option value="">Wybierz...</option>
                 <?php foreach ($type as $t) {
                     echo '<option value='.$t['type_id'].'>'.$t['name'].'</option>';}?>
              </select>
			</div>
			
			<div class="col-sm-2">
              <label for="place" class="form-label">Miejscowość</label>
              <input type="text" class="form-control" name="place" placeholder="" value="" minlength="3">
            </div>

            <div class="col-sm-2">
              <label for="street" class="form-label">Ulica</label>
              <input type="text" class="form-control" name="street" placeholder="" value="" minlength="3">
            </div>
            
			<div class="col-sm-2">
              <label for="streetnr" class="form-label">Numer</label>
              <input type="text" class="form-control" name="streetnr" placeholder="" value="" minlength="1">
            </div>

            <div class="col-md-2">
              <label for="state" class="form-label">Status</label>
              <select class="form-select" name="state" >
                <option value="">Wybierz...</option>
                 <?php foreach ($states as $s) {
                     echo '<option value='.$s['task_state_id'].'>'.$s['task_state_name'].'</option>';}?>
              </select>
			</div>
			<div class="col-sm-2">
              <label for="data" class="form-label">Data</label>
              <input type="date" class="form-control" name="date" placeholder="" value="">
            </div>

            <div class="col-md-2">
              <label for="technik" class="form-label">Technik</label>
              <select class="form-select" name="tech" >
                <option value="">Wybierz...</option>
                 <?php foreach ($technik as $t) {
                     echo '<option value='.$t['user_id'].'>'.$t['name'].' '.$t['second_name'].'</option>';}?>
              </select>
			</div>


            <div class="col-md-2">
              <label for="dysp" class="form-label">Dyspozytor</label>
              <select class="form-select" name="dysp" >
                <option value="">Wybierz...</option>
                 <?php foreach ($dyspozytor as $d) {
                     echo '<option value='.$d['user_id'].'>'.$d['name'].' '.$d['second_name'].'</option>';}?>
              </select>
			</div>

            </div>
               <div class="col-md-2">
               <br>
               
               <button class="btn btn-primary btn-lg" type="submit" name="findtask-submit">Znajdź</button>
               </div>
        </form>
   <?php
                  if(isset($_GET['msg'])){

                    echo "<center><h4 style='color:red'>Podaj kryteria wyszukiwania!</h4></center>";
                  }

                if(isset($_GET['all'])){

                  $area = $_GET['area'];
                  $task = $_GET['task'];
                  $type = $_GET['type'];
                  $place = $_GET['place'];
                  $street = $_GET['street'];
                  $streetnr = $_GET['streetnr'];
                  $state = $_GET['state'];
                  $data = $_GET['data'];
                  $technik = $_GET['tech'];
                  $dysp = $_GET['dysp'];
                  $edate= ''.$data.' 23:59:59';
                  $sdate= ''.$data.' 00:00:00';
  

                    $findtask = DB::query('SELECT * FROM archive, types, area, task_state 
                    WHERE archive.area_id=area.area_id 
                    AND archive.type_id=types.type_id 
                    AND archive.end_status=task_state.task_state_id 
                    AND (:area="" OR archive.area_id = :area) 
                    AND (:task="" OR archive.task_id = :task) 
                    AND (:typ="" OR archive.type_id = :typ) 
                    AND (:place="" OR archive.place = :place)  
                    AND (:street="" OR archive.street = :street)
                    AND (:streetnr="" OR archive.place_number = :streetnr)
                    AND (:stat="" OR archive.end_status = :stat)
                    AND (:data1="" OR archive.time_set BETWEEN :f1data AND :f2data )
                    AND (:tech="" OR archive.done_by = :tech)
                    AND (:dysp="" OR archive.archived_by = :dysp)

                    ;', 
                    array(':area'=>$area, ':task'=>$task, ':typ'=>$type, ':place'=>$place, ':street'=>$street, ':streetnr'=>$streetnr, ':stat'=>$state, ':data1'=>$data, ':f1data'=>$sdate, ':f2data'=>$edate, ':tech'=>$technik, ':dysp'=>$dysp));
                    if(!$findtask){
                        echo "<center><h4 style='color:red'>Brak takiego zlecenia!</h4></center>";
                    }
                    else{
                        echo '<table class="table table-sm table-bordered">
                              <thead>
                              <tr>
                                <th scope="col">Nr zlecenia</th>
                                <th scope="col">Typ</th>
                                <th scope="col">Rejon</th>
                                <th scope="col">Miejscowość</th>
                                <th scope="col">Ulica</th>
                                <th scope="col">Nr</th>
                                <th scope="col">Data</th>
                                <th scope="col">Status</th>
                                <th scope="col">Technik</th>
                                <th scope="col">Dyspozytor</th>
                              </tr>
                              </thead>
                              <tbody>';

                              foreach ($findtask as $un) {
                                $technik = DB::query("SELECT CONCAT(name,' ',second_name) AS fname FROM users WHERE user_id=:uid;", array(':uid'=>$un['done_by']))[0]['fname'];
                                $dyspozytor = DB::query("SELECT CONCAT(name,' ',second_name) AS fname FROM users WHERE user_id=:uid;", array(':uid'=>$un['archived_by']))[0]['fname'];
                                echo '<tr><form action="archivetasks.php?id='.$un['task_id'].'" method="post">
                                
                                        <th scope="col"><center><button name="archivetask-find" type="submit" class="btn btn-primary btn-sm">'.$un['task_id'].'</center></th>
                                        <th scope="col">'.$un['name'].'</th>
                                        <th scope="col">'.$un['area_name'].'</th>
                                        <th scope="col">'.$un['place'].'</th>
                                        <th scope="col">'.$un['street'].'</th>
                                        <th scope="col">'.$un['place_number'].'</th>
                                        <th scope="col">'.$un['time_set'].'</th>
                                        <th scope="col">'.$un['task_state_name'].'</th>
                                        <th scope="col">'.$technik.'</th>
                                        <th scope="col">'.$dyspozytor.'</button></th>
                                        
                                        </form>
                                      </tr>';
                              }

                     echo '</tbody></table>';
                    }
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
    
<?php }
            else{
                header("Location: ../index.php");
            }
?>