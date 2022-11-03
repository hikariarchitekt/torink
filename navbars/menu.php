<?php
session_start();
 if(isset($_SESSION['userId'])){
$myarea = DB::query('SELECT area_name FROM area WHERE area_id=:areaid', array(':areaid'=>$_SESSION['id_area']))[0]['area_name'];
$myrole = DB::query('SELECT role_name FROM roles WHERE role_id=:roleid', array(':roleid'=>$_SESSION['role']))[0]['role_name'];
 }
 else{
                header("Location: ../index.php");
            }
?>
 <div class="container-fluid">
  <div class="row">
 <nav id="sidebarMenu" class="col-md-3 col-lg-2 d-md-block bg-light sidebar collapse">
      <div class="position-sticky pt-3 sidebar-sticky">
        <ul class="nav flex-column">
           <li class="nav-item">
            <a class="nav-link active" href="#" style="pointer-events: none; display: inline-block;">
              <span  class="align-text-bottom"></span>
              <?php echo $myarea.' - '.$myrole ?>
            </a>
          </li>
          <li class="nav-item">
            <a class="nav-link" aria-current="page" href="../dashboard/index.php">
              <span data-feather="home" class="align-text-bottom"></span>
              Home
            </a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="../tasks/tasks.php">
              <span data-feather="file" class="align-text-bottom"></span>
              Zlecenia
            </a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="#">
              <span data-feather="package" class="align-text-bottom"></span>
              Magazyn
            </a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="../workers/workers.php">
              <span data-feather="users" class="align-text-bottom"></span>
              Pracownicy
            </a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="#">
              <span data-feather="bar-chart-2" class="align-text-bottom"></span>
              Raporty
            </a>
          </li>     
          <li class="nav-item">
            <a class="nav-link" href="../workers/settings.php">
              <span data-feather="settings" class="align-text-bottom"></span>
              Ustawienia
            </a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="../assets/fun/logout.php">
              <span data-feather="log-out" class="align-text-bottom"></span>
              Wyloguj
            </a>
          </li>
        </ul>
      </div>
    </nav>