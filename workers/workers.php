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

    <title>Pracownicy</title>
  </body>
    <main class="col-md-9 ms-sm-auto col-lg-10 px-md-4">
      <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
        <h1 class="h1">Pracownicy</h1>
      </div>
      <div class="col-md-7 col-lg-8">
        <?php 
    if($role_id==1){?>
    <div class="d-flex gap-5 justify-content-center">
      <div class="col-4 col-sm-2 themed-grid-col"><a href="addworker.php"><button type="button" class="btn btn-success">Dodaj pracownika</button></a></div>
      <div class="col-4 col-sm-3 themed-grid-col"><a href="showworkers.php"><button type="button" class="btn btn-primary">Wyświetl pracowników</button></a></div>
    </div>
    <?php }
    else{ ?>
        <div class="d-flex gap-5 justify-content-center">
      <div class="col-4 col-sm-2 themed-grid-col"><a href="showworkers.php"><button type="button" class="btn btn-primary">Wyświetl pracowników</button></a></div>
    </div>
   <?php }?>

   <h1 class="h4">Informacje ogólne:</h1>
    <table class="table table-hover">
          <tr class="table-primary">
            <th scope="row">Wszyscy pracownicy</th>
            <td><?php echo $all = DB::query('SELECT COUNT(*) as id FROM users WHERE state_id!=:userstate', array(':userstate'=>2))[0]['id']; ?> </td>
          </tr>
          <tr class="table-success">
            <th scope="row">Obecnie pracujący</th>
            <td><?php echo $curr = DB::query('SELECT COUNT(*) as id FROM users WHERE state_id=:userstate OR state_id=3', array(':userstate'=>2))[0]['id']; ?></td>
          </tr>
          <tr class="table-warning">
            <th scope="row">Urop</th>
            <td><?php echo $u = DB::query('SELECT COUNT(*) as id FROM users WHERE state_id=:userstate', array(':userstate'=>5))[0]['id']; ?></td>
          </tr>
           <tr class="table-danger">
            <th scope="row">Zwolnienie lekarskie</th>
            <td><?php echo $l4 = DB::query('SELECT COUNT(*) as id FROM users WHERE state_id=:userstate', array(':userstate'=>6))[0]['id']; ?></td>
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