<?php
  include '..\assets\fun\db.php';
  include '..\assets\fun\dbd.php';
  include '..\navbars\header.php';
  include '..\navbars\head.php';
  include '..\navbars\menu.php';
  $myid = $_SESSION['userId'];
  $role_id = $_SESSION['role'];
   if(isset($_SESSION['userId']) && ($role_id==3 ||  $role_id==5)){
   $technik = DB::query('SELECT * FROM users WHERE role_id=5'); 
   $dyspozytor = DB::query('SELECT * FROM users WHERE role_id=3'); 
   ?>

    <title>Moje Zlecenia</title>
  </body>
    <main class="col-md-9 ms-sm-auto col-lg-10 px-md-4">
      <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
        <h1 class="h1">Moje Zlecenia</h1>
        
      </div>
<div class="col-md-7 col-lg-8">

   <?php 
                  if($role_id==3){
                    $dysp=$myid;
                    $tech="";
                  }
                  elseif ($role_id==5) {
                    $dysp="";
                    $tech=$myid;
                 }

                    $findtask = DB::query('SELECT * FROM tasks, types, area, task_state 
                    WHERE tasks.area_id=area.area_id 
                    AND tasks.type_id=types.type_id 
                    AND tasks.task_status_id=task_state.task_state_id
                    AND (:tech="" OR tasks.assigned_to = :tech)
                    AND (:dysp="" OR tasks.dispatcher = :dysp)
                    ;', 
                    array(':tech'=>$tech, ':dysp'=>$dysp));
                    if(!$findtask){
                        echo "<center><h4 style='color:red'>Żadne zlecenie nie jest do przypisane do Ciebie!</h4></center>";
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
                                if($un['assigned_to'])
                                $technik = DB::query("SELECT CONCAT(name,' ',second_name) AS fname FROM users WHERE user_id=:uid;", array(':uid'=>$un['assigned_to']))[0]['fname'];
                                else
                                $technik = NULL;
                                if($un['dispatcher'])
                                $dyspozytor = DB::query("SELECT CONCAT(name,' ',second_name) AS fname FROM users WHERE user_id=:uid;", array(':uid'=>$un['dispatcher']))[0]['fname'];
                                else
                                $dyspozytor = NULL;
                                echo '<tr><form action="task.php?id='.$un['task_id'].'" method="post">
                                
                                        <th scope="col"><center><button name="task-find" type="submit" class="btn btn-primary btn-sm">'.$un['task_id'].'</center></th>
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