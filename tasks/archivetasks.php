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
    if(isset($_POST['archivetask-find'])||($_GET['id'])){  
      $tid = $_GET['id'];
      $task = DB::query('SELECT * FROM archive, area, types, task_state WHERE task_id=:tid AND area.area_id=archive.area_id AND types.type_id=archive.type_id AND task_state.task_state_id=archive.end_status;', array(':tid'=>$tid));
        echo '<h1 class="h1">Nr zlecenia: '.$tid.'</h1></div>';
     
      foreach ($task as $t) {
        if($t['done_by'])
        $technik = DB::query("SELECT CONCAT(name,' ',second_name) AS fname FROM users WHERE user_id=:uid;", array(':uid'=>$t['done_by']))[0]['fname'];
        else
        $technik = NULL;
        if($t['archived_by'])
        $dyspozytor = DB::query("SELECT CONCAT(name,' ',second_name) AS fname FROM users WHERE user_id=:uid;", array(':uid'=>$t['archived_by']))[0]['fname'];
        else
        $dyspozytor = NULL;

        echo 
        '<table class="table table-lg">
        <tr class="table-secondary"> 
        <th scope="col">Rejon</th>
        <th scope="col">Typ</th>
        <th scope="col">Status</tr>
      <tr class="table-primary">                
        <th scope="col">'.$t['area_name'].'</th>
        <th scope="col">'.$t['name'].'</th>
        <th scope="col">'.$t['task_state_name'].' <br>'.$t['status_option'].'</th>
      </tr>

      <tr class="table-secondary">
        <th scope="col">Planowany czas realizacji</th>
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
      <th scope="col">Technik</th>
      <th scope="col">Dyspozytor</th>
      <th scope="col">Odpis</th>
      </tr>
      <tr class="table-primary">
      <th scope="col">'.$technik.'</th>
      <th scope="col">'.$dyspozytor.'</th>
      <th scope="col">'.$t['end_desc'].'</th>
      </tr>
      <tr class="table-secondary">
      <th scope="col">Wykorzystany sprzęt</th>
      </tr>
      <tr class="table-primary">
      <th scope="col">'.$t['used_eq'].'</th>
      </tr>
      </table>
      ';
      }
        ?>
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