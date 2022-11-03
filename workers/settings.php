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
  $user = DB::query('SELECT * FROM users WHERE user_id=:usid', array(':usid'=>$myid));
  $rola = DB::query('SELECT * FROM roles WHERE role_id=:usid', array(':usid'=>$role_id))[0]['role_name'];
  if(isset($_SESSION['userId'])){ ?>
  
    <title>Pracownicy</title>
  </body>
    <main class="col-md-9 ms-sm-auto col-lg-10 px-md-4">
      <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">

      <h1 class="h1">Ustawienia:</h1>


      </div>
      
      <div class="bd-example-snippet bd-code-snippet">
        <div class="alert alert-warning alert-dismissible fade show" role="alert">
          Jeśli dane są niepoprawne lub nieaktualne skontaktuj się z administratorem.
          <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
        </div>
        <?php 
        foreach($user as $u){
   echo '<h4 class="h4">Twoje dane:</h4>
   
   <div class="row mb-3 text-center">
   <div class="col-3 themed-grid-col">Imię Nazwisko:</div>
   <div class="col-1 themed-grid-col">'.$myname.' '.$my2name.'</div>
  </div>

   <div class="row mb-3 text-center">
      <div class="col-3 themed-grid-col">Login:</div>
      <div class="col-1 themed-grid-col">'.$u['user_name'].'</div>
    </div>

    <div class="row mb-3 text-center">
    <div class="col-3 themed-grid-col">Telefon:</div>
    <div class="col-1 themed-grid-col">'.$u['phone'].'</div>
    </div>

  <div class="row mb-3 text-center">
  <div class="col-3 themed-grid-col">Email:</div>
  <div class="col-1 themed-grid-col">'.$u['mail'].'</div>
  </div>
  <div class="row mb-3 text-center">
  <div class="col-3 themed-grid-col">Rola:</div>
  <div class="col-1 themed-grid-col">'.$rola.'</div>
  </div>
      
    ';
  }

  echo '<h4 class="h4">Zmień hasło:</h4><form class="needs-validation" action="..\assets\fun\updatepass.php" method="post">
    <div class="row mb-3 text-center">
    <div class="col-3 themed-grid-col">Podaj stare hasło:</div>
    <div class="col-1 themed-grid-col"><input type="password" name="oldpass" placeholder="" value="" minlength="3"required></div>
  </div>
  <div class="row mb-3 text-center">
  <div class="col-3 themed-grid-col">Podaj nowe hasło:</div>
  <div class="col-1 themed-grid-col"><input type="password" name="newpass" placeholder="" value="" minlength="3" required></div>
</div>
<div class="row mb-3 text-center">
<div class="col-3 themed-grid-col">Powtórz nowe hasło:</div>
<div class="col-1 themed-grid-col"><input type="password" name="newpass2" placeholder="" value="" minlength="3" required></div>
</div>
<div class="row mb-3 text-center">
<div class="col-3 themed-grid-col"></div>
<div class="col-1 themed-grid-col"><button class="btn btn-primary btn-sm" type="submit" name="passupdate-submit">Zmień</button>
</form></div>
</div>
  ';
  if(isset($_GET['error'])){
    if($_GET['error']=="emptyform"){
        echo "<h4 style='color:red'>Uzupełnij wszystkie pola!</h4>";
    }
    else if($_GET['error']=="wrongpass"){
        echo "<h4 style='color:red'>Wprowadź prawidłowe obecne hasło!</h4>";
    }

    else if($_GET['error']=="notsame"){
      echo "<h4 style='color:red'>Wprowadzone wartości nie są takie same!</h4>";
  }
    
}
else if(isset($_GET['operation'])){
     if($_GET['operation']=="success"){
        echo "<h4 style='color:green'>Hasło zostało zmienione!</h4>";
    } 
}
    ?>
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