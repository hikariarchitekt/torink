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

    <title>Zlecenia</title>
  </body>
    <main class="col-md-9 ms-sm-auto col-lg-10 px-md-4">
      <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
        <h1 class="h1">Zlecenia</h1>
      </div>
      <div class="col-md-7 col-lg-8">
        <?php 
    if($role_id==1 || $role_id==6){?>
    <div class="d-flex gap-5 justify-content-center">
      <div class="col-4 col-sm-2 themed-grid-col"><a href="addtask.php"><button type="button" class="btn btn-success">Dodaj zlecenie</button></a></div>
      <div class="col-4 col-sm-2 themed-grid-col"><a href="showtasks.php"><button type="button" class="btn btn-primary">Wyświetl zlecenia</button></a></div>
    </div>
    <?php }
    else{ ?>
        <div class="d-flex gap-5 justify-content-center">
      <div class="col-4 col-sm-2 themed-grid-col"><a href="showtasks.php"><button type="button" class="btn btn-primary">Wyświetl zlecenia</button></a></div>
    </div>
   <?php }?>
   
   <h1 class="h4">Informacje ogólne</h1>
    <table class="table table-hover">
          <tr class="table-primary">
            <th scope="row">Wszystkie zlecenia w buforze</th>
            <td><?php echo $bufor = DB::query('SELECT COUNT(*) as bufor FROM tasks WHERE task_status_id=:state', array(':state'=>1))[0]['bufor']; ?> </td>
          </tr>
          <tr class="table-warning">
            <th scope="row">W realizacji</th>
            <td><?php echo $realizacja = DB::query('SELECT COUNT(*) as realizacja FROM tasks WHERE task_status_id=:state1 OR task_status_id=:state2 OR task_status_id=:state3 OR task_status_id=:state4  OR task_status_id=:state5', array(':state1'=>2, ':state2'=>3, ':state3'=>4, ':state4'=>5, ':state5'=>6))[0]['realizacja'];  ?></td>
          </tr>
          <tr class="table-success">
            <th scope="row">Skutecznie</th>
            <td><?php echo $skutecznie = DB::query('SELECT COUNT(*) as skut FROM tasks WHERE task_status_id=:state', array(':state'=>7))[0]['skut']; ?></td>
          </tr>
           <tr class="table-danger">
            <th scope="row">Niesktutecznie</th>
            <td><?php echo $niesku = DB::query('SELECT COUNT(*) as nies FROM tasks WHERE task_status_id=:state', array(':state'=>8))[0]['nies']; ?></td>
          </tr>
          </tbody>
        </table>
      </div>
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