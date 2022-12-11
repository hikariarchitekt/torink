<?php
  include '..\assets\fun\db.php';
  include '..\assets\fun\dbd.php';
  include '..\navbars\header.php';
  include '..\navbars\head.php';
  include '..\navbars\menu.php';
  $myid = $_SESSION['userId'];
  $myname = $_SESSION['username'];
  $my2name = $_SESSION['user2name'];
  $role_id = $_SESSION['role'];
  if(isset($_SESSION['userId'])){ ?>

 <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.1/jquery.min.js"></script>
 <script>
$(document).ready(function() {
    $("#sts").change(function () {
        $("#option_select")
            .find("option")
            .show()
            .not("option[value*='" + this.value + "']").hide();
       
        $("#option_select").val(
            $("#option_select").find("option:visible:first").val());
        
    }).change();
});
 </script>
    <title>Zlecenie</title>
  </body>
    <main class="col-md-9 ms-sm-auto col-lg-10 px-md-4">
      <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
      <?php 
    if(isset($_POST['task-find'])||($_GET['id'])){  
      $tid = $_GET['id'];
      $task = DB::query('SELECT * FROM tasks, area, types, task_state WHERE task_id=:tid AND area.area_id=tasks.area_id AND types.type_id=tasks.type_id AND task_state.task_state_id=tasks.task_status_id;', array(':tid'=>$tid));
      $taskstatus = DB::query('SELECT task_status_id FROM tasks WHERE task_id=:tid;', array(':tid'=>$tid))[0]['task_status_id'];
        echo '<h1 class="h1">Nr zlecenia: '.$tid.'</h1></div>';
      if($role_id==5 && ($taskstatus==2 || $taskstatus==3)){
        echo 
        '<div class="d-flex gap-5 justify-content-center">
        <form action="../assets/fun/updatestatusbyworker.php" method="post">
        <input type="hidden" name="tid" value="'.$tid.'" />
        <input type="hidden" name="status" value="4" />
        <input type="submit" class="btn btn-primary btn-lg" name="start-submit" value="PODEJMIJ ZLECENIE"/>
        </form></div>';
    }
    elseif($role_id==5 && ($taskstatus==4)){
        echo 
        '<div class="d-flex gap-5 justify-content-center">
        <form action="../assets/fun/updatestatusbyworker.php" method="post">
        <input type="hidden" name="tid" value="'.$tid.'" />
        <input type="hidden" name="status" value="5" />
        <input type="submit" class="btn btn-info btn-lg" name="onmyway-submit" value="W DRODZE"/>
        </form></div>';
    }
    elseif($role_id==5 && ($taskstatus==5)){
        echo 
        '<div class="d-flex gap-5 justify-content-center">
        <form action="../assets/fun/updatestatusbyworker.php" method="post">
        <input type="hidden" name="tid" value="'.$tid.'" />
        <input type="hidden" name="status" value="6" />
        <input type="submit" class="btn btn-success btn-lg" name="install-submit" value="START"/>
        </form></div>';
    }
        elseif($role_id==5 && ($taskstatus==6)){
        echo 
        '<div class="d-flex gap-5 justify-content-center">
        <button type="button" class="btn btn-success btn-lg" data-bs-toggle="modal" data-bs-target="#odpisz">
           ODPISZ ZLECENIE
        </button></div><br>';
    }

      foreach ($task as $t) {
        if($t['assigned_to'])
        $technik = DB::query("SELECT CONCAT(name,' ',second_name) AS fname FROM users WHERE user_id=:uid;", array(':uid'=>$t['assigned_to']))[0]['fname'];
        else
        $technik = NULL;
        if($t['dispatcher'])
        $dyspozytor = DB::query("SELECT CONCAT(name,' ',second_name) AS fname FROM users WHERE user_id=:uid;", array(':uid'=>$t['dispatcher']))[0]['fname'];
        else
        $dyspozytor = NULL;

        echo 
        '<table class="table table-lg">
        <tr class="table-secondary"> 
        <th scope="col">Rejon</th>
        <th scope="col">Typ</th>
        <th scope="col">';
            if($role_id==3 || $role_id==1){
            echo'
            <button type="button" class="btn btn-secondary btn-sm" data-bs-toggle="modal" data-bs-target="#statuschange">
            Status
            </button></th>';
            }
            else{
            echo'
            Status</th>';
            }
       echo
        '</tr>
      <tr class="table-primary">                
        <th scope="col">'.$t['area_name'].'</th>
        <th scope="col">'.$t['name'].'</th>
        <th scope="col">'.$t['task_state_name'].'</th>
      </tr>

      <tr class="table-secondary">
        <th scope="col">';

        if($role_id==3 || $role_id==1){
            echo'
                <form action="update.php" method="post">
                <input type="hidden" name="tid" value='.$tid.'" />
                <input type="submit" class="btn btn-secondary btn-sm" data-bs-toggle="modal" name="update-submit" value="Zaplanowano na"/>
                </form>';
            }
            else{
            echo'
            Zaplanowano na';
            }
       echo
        '</th>
        <th scope="col">Czas rozpoczęcia</th>
        <th scope="col">Czas zakończenia</th>
      </tr>
      <tr class="table-primary">                
        <th scope="col">'.$t['time_set'].'</th>
        <th scope="col">'.$t['time_start'].'</th>
        <th scope="col">'.$t['time_end'].'</th>
      </tr>

      
      <tr class="table-secondary">
      <th scope="col">Miejscowość</th>
      <th scope="col">Ulica</th>
      <th scope="col">Nr</th>
      </tr>
      <tr class="table-primary">
      <th scope="col">'.$t['place'].'</th>
      <th scope="col">'.$t['street'].'</th>
      <th scope="col">'.$t['place_number'].'</th>
      </tr>
      <tr class="table-secondary">
      <th scope="col">Klient</th>
      <th scope="col">Telefon</th>
      <th scope="col">Opis</th>
      </tr>
      <tr class="table-primary">
      <th scope="col">'.$t['client_name'].'</th>
      <th scope="col">
      <a class="nav-link" href="tel:+48'.$t['client_phone'].'">'.$t['client_phone'].'</a>
      </th>
      <th scope="col">'.$t['description'].'</th>
      </tr>
      <tr class="table-secondary">
      <th scope="col">';
          if($role_id==3 || $role_id==1){
            echo'
                <button type="button" class="btn btn-secondary btn-sm" data-bs-toggle="modal" data-bs-target="#technik">
                  Technik
                  </button>';
           }
            else{
               echo'Technik';
               }
       echo
      '</th>
      <th scope="col">Dyspozytor</th>
      </tr>
      <tr class="table-primary">
      <th scope="col">'.$technik.'</th>
      <th scope="col">'.$dyspozytor.'</th>
      </tr>
      </table>
      ';
      }
            if($role_id==5  || $role_id==3){
        $eq = DB::query('SELECT * FROM required_task, equipment WHERE task_id=:tid AND equipment.equipment_id=required_task.equipment_id;', array(':tid'=>$tid));
        echo '
        <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
        <h1>Wymagany sprzęt</h1></div>
        <table class="table table-lg">
                            <tbody>
                              ';

        foreach ($eq as $e) {
                     echo '<tr><th>'.$e['name'].'</th></tr>';
                 }
                 echo '</tbody></table>';
             }

       if(($role_id==5 || $role_id==3) && ($taskstatus==7 || $taskstatus==8 || $taskstatus==9)){
           $task_desc = DB::query('SELECT * FROM tech_task_dsc, task_state, users WHERE tech_task_dsc.task_id=:tid AND task_state.task_state_id=tech_task_dsc.task_status_id AND users.user_id=tech_task_dsc.tech_id;', array(':tid'=>$tid));
            echo'
        <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
        <h1>Odpis</h1>';
        if($role_id==5){
          echo
        '<div class="d-flex gap-5 justify-content-center">
        <button type="button" class="btn btn-info btn-lg" data-bs-toggle="modal" data-bs-target="#odpisz">
           EDYTUJ ODPIS
        </button>
        </div>';}
        elseif($role_id==3 && ($taskstatus==7 || $taskstatus==8 || $taskstatus==9)){
        echo 
        '<div class="d-flex gap-5 justify-content-center">
        <form action="../assets/fun/archivetask.php" method="post">
        <input type="hidden" name="tid" value="'.$tid.'" />
        <input type="submit" class="btn btn-info btn-lg" name="archive-submit" value="ZAMKNIJ ZLECENIE I ARCHIWIZUJ"/>
        </form></div>';
    }



        echo '
        </div>';
         foreach ($task_desc as $t) {
             echo '<table class="table table-lg"><thead>
                      <tr>
                        <th>STATUS</th>
                        <th>OPCJA</th>
                        <th>ODPIS</th>
                        <th>TECHNIK</th>
                      </tr>
                    </thead>
                    <tbody>
                      <tr>
                        <td>'.$t['task_state_name'].'</td>
                        <td>'.$t['status_option'].'</td>
                        <td>'.$t['task_desc'].'</td>
                        <td>'.$t['name'].' '.$t['second_name'].'</td>
                      </tr></tbody></table>';


         }
     }

        ?>
      </div>

          <div class="modal fade" id="statuschange" tabindex="-1" aria-labelledby="exampleModalLabel" style="display: none;" aria-hidden="true">
            <div class="modal-dialog">
              <div class="modal-content">
                <div class="modal-header">
                  <h5 class="modal-title" id="statuschange">Zmień status</h5>
                  <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                <?php
              echo '<form class="needs-validation" action="../assets/fun/updatetaskstatus.php?id='.$tid.'&w='.$myid.'" method="post">';
              $st = DB::query('SELECT * FROM task_state');
              ?>

              <select class="form-select" name="status">
                <option value="">Wybierz...</option>
                 <?php foreach ($st as $s) {
                    if($s['task_state_id']!=3 && $s['task_state_id']!=4 && $s['task_state_id']!=5 && $s['task_state_id']!=6)
                     echo '<option value='.$s['task_state_id'].'>'.$s['task_state_name'].'</option>';}?>
              </select>
            </div>
                
                <div class="modal-footer">
                  <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Zamknij</button>
                  <button type="submit" class="btn btn-primary" name="status-submit">Zatwierdź</button></form>
                </div>
              </div>
            </div>
      </div>
</div>

<div class="modal fade" id="technik" tabindex="-1" aria-labelledby="exampleModalLabel" style="display: none;" aria-hidden="true">
            <div class="modal-dialog">
              <div class="modal-content">
                <div class="modal-header">
                  <h5 class="modal-title" id="technik">Przypisz technika</h5>
                  <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                <?php
              echo '<form class="needs-validation" action="../assets/fun/updatetaskworker.php" method="post">
              <input type="hidden" name="taskid" value="'.$tid.'"/>';
              $tk = DB::query('SELECT * FROM users WHERE role_id=5');
              $obszar = DB::query('SELECT area_id FROM tasks WHERE task_id=:tid', array(':tid'=> $tid))[0]['area_id'];
              ?>
      
              <select class="form-select" name="tech">
                <option value="">Wybierz...</option>
                 <?php foreach ($tk as $t) {
                    if($t['area_id']==$obszar)
                     echo '<option value='.$t['user_id'].'>'.$t['name'].' '.$t['second_name'].'</option>';}

                    foreach ($tk as $t) {
                      if($t['area_id']!=$obszar)
                      echo '<option value='.$t['user_id'].'>'.$t['name'].' '.$t['second_name'].'</option>';}
                     ?>
              </select>
            </div>
                
                <div class="modal-footer">
                  <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Zamknij</button>
                  <button type="submit" class="btn btn-primary" name="worker-submit">Zatwierdź</button></form>
                </div>
              </div>
            </div>
      </div>

<div class="modal fade" id="odpisz" tabindex="-1" aria-labelledby="exampleModalLabel" style="display: none;" aria-hidden="true">
            <div class="modal-dialog">
              <div class="modal-content">
                <div class="modal-header">
                  <h5 class="modal-title" id="odpisz">Odpisz zlecenie</h5>
                  <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                <?php
              echo '<form class="needs-validation" action="../assets/fun/odpisz.php" method="post">
              <input type="hidden" name="taskid" value="'.$tid.'"/>
              <input type="hidden" name="techid" value="'.$myid.'"/>';
               
              ?>
              <label for="sts">Status:</label>
             <select class="form-select" name="sts" id="sts" required>
                <option value="">Wybierz...</option>
                <option value="7">SKUTECZNIE</option>
                <option value="8">NIESKUTECZNIE</option>
                <option value="9">ZMIANA TERMINU</option>
            </select>
            <br>
               <select  class="form-select" name="option_select" id="option_select" required>
                <option value="">Wybierz...</option>
                <!--Below shows when '1 column' is selected is hidden otherwise-->
                <option value="7_Standard Napowietrzny">Standard Napowietrzny</option>
                <option value="7_Standard Doziemny">Standard Doziemny</option>
    
                <!--Below shows when '2 column' is selected is hidden otherwise-->
                <option value="8_Rezygnacja klienta">Rezygnacja klienta</option> 
                <option value="8_Brak możliwości">Brak możliwości</option>
                <option value="8_>Inne">Inne</option>
    
                <!--Below shows when '3 column' is selected is hidden otherwise-->
                <option value="9_Na prośbę klienta">Na prośbę klienta</option>
                <option value="9_Złe warunki atmosferyczne">Złe warunki atmosferyczne</option>
                <option value="9_other">Inne</option>
            </select>

              <label for="opis">Odpis dla dyspozytora:</label>
              <div class="input-group">
                  <textarea class="form-control" aria-label="With textarea" name="opis" required></textarea>
              </div>

            </div>
                
                <div class="modal-footer">
                  <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Zamknij</button>
                  <button type="submit" class="btn btn-primary" name="odpisz-submit">Zatwierdź</button></form>
                </div>
              </div>
            </div>
      </div>



      <?php } 

      else{
        echo '<center><h4 style="color:red">Spróbuj jeszcze raz!</h4></center>';
      }?>
    </main>
    <script src="../assets/dist/js/bootstrap.bundle.min.js"></script>
      <script src="https://cdn.jsdelivr.net/npm/feather-icons@4.28.0/dist/feather.min.js" integrity="sha384-uO3SXW5IuS1ZpFPKugNNWqTZRRglnUJK6UAZ/gxOX80nxEkN9NcGZTftn6RzhGWE" crossorigin="anonymous"></script><script src="https://cdn.jsdelivr.net/npm/chart.js@2.9.4/dist/Chart.min.js" integrity="sha384-zNy6FEbO50N+Cg5wap8IKA4M/ZnLJgzc6w2NqACZaK0u0FXfOWRRJOnQtpZun8ha" crossorigin="anonymous"></script><script src="..\navbars\dashboard.js"></script>
  </body>
</html>
    
<?php }
            else{
                header("Location: ../index.php");
            }
?>