<?php
  include '..\assets\fun\db.php';
  include '..\assets\fun\dbd.php';
  include '..\navbars\header.php';
  include '..\navbars\head.php';
  include '..\navbars\menu.php';
  $myid = $_SESSION['userId'];
   if(isset($_SESSION['userId'])){?>

    <title>Pokaż pracowników</title>
  </body>
    <main class="col-md-9 ms-sm-auto col-lg-10 px-md-4">
      <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
        <h1 class="h1">Dodaj pracownika</h1>
        
      </div>
      <?php
      if($myid==1){
       $areas = DB::query('SELECT * FROM area');    
       $roles = DB::query('SELECT * FROM roles');
       $states = DB::query('SELECT * FROM states');  
      ?>
   <h1 class="h4">Forlumarz:</h1>
<div class="col-md-7 col-lg-8">
        <form class="needs-validation" action="..\assets\fun\addnewuser.php" method="post">
          <div class="row g-3">
            <div class="col-sm-6">
              <label for="firstName" class="form-label">Imię</label>
              <input type="text" class="form-control" name="firstName" placeholder="" value="" minlength="3" required>
              <div class="invalid-feedback">
                Podaj imię!
              </div>
            </div>

            <div class="col-sm-6">
              <label for="lastName" class="form-label">Nazwisko</label>
              <input type="text" class="form-control" name="lastName" placeholder="" value="" minlength="3" required>
              <div class="invalid-feedback">
                Podaj nazwisko!
              </div>
            </div>

            <div class="col-sm-6">
              <label for="username" class="form-label">Nazwa użytkownika</label>
              <div class="input-group has-validation">
                <input type="text" class="form-control" name="username" placeholder="Nazwa użytkownika" minlength="5" required>
              <div class="invalid-feedback">
                  Podaj nazwę użytkownika!
                </div>
              </div>
            </div>

            <div class="col-sm-6">
              <label for="password" class="form-label">Hasło</label>
              <div class="input-group has-validation">
                <input type="password" class="form-control" name="password" placeholder="***** ***"  minlength="8" required>
              <div class="invalid-feedback">
                  Podaj nazwę hasło!
                </div>
              </div>
            </div>

             <div class="col-sm-6">
              <label for="email" class="form-label">Email</label>
              <div class="input-group has-validation">
                <input type="email" class="form-control" name="email" placeholder="nazwa@example.com" required>
              <div class="invalid-feedback">
                  Podaj prawidłowy adres email.
                </div>
              </div>
            </div>

            <div class="col-sm-6">
              <label for="phone" class="form-label">Telefon</label>
              <input type="phone" class="form-control" name="phone" placeholder="123 456 789" minlength="9" maxlength="9" required>
              <div class="invalid-feedback">
                Podaj prawidłowy numer telefonu.
              </div>
            </div>
           
            <div class="col-md-4">
              <label for="country" class="form-label">Rejon</label>
              <select class="form-select" name="area" required>
                <option value="">Wybierz...</option>
                 <?php foreach ($areas as $a) {
                     echo '<option value='.$a['area_id'].'>'.$a['area_name'].'</option>';}?>
              </select>
              <div class="invalid-feedback">
                Wybierz rejon!
              </div>
            </div>

            <div class="col-md-4">
              <label for="state" class="form-label">Rola</label>
              <select class="form-select" name="role" required>
                <option value="">Wybierz...</option>
                 <?php foreach ($roles as $r) {
                     echo '<option value='.$r['role_id'].'>'.$r['role_name'].'</option>';}?>
              </select>
              <div class="invalid-feedback">
                Wybierz rolę!
              </div>
            </div>

            <div class="col-md-4">
              <label for="state" class="form-label">Status</label>
              <select class="form-select" name="state" required>
                <option value="">Wybierz...</option>
                 <?php foreach ($states as $s) {
                     echo '<option value='.$s['state_id'].'>'.$s['state'].'</option>';}?>
              </select>
              <div class="invalid-feedback">
                Wybierz status!
              </div>
            </div>
             <button class="w-100 btn btn-primary btn-lg" type="submit" name="adduser-submit">Dodaj</button>
        </form>
   <?php
               if(isset($_GET['error'])){
                if($_GET['error']=="emptyform"){
                    echo "<center><h4 style='color:red'>Uzupełnij formularz!</h4></center>";
                }
                else if($_GET['error']=="sqlerror"){
                    echo "<center><h4 style='color:red'>Nieznay błąd!</h4></center>";
                }
                else if($_GET['error']=="nametaken"){
                    echo "<center><h4 style='color:red'>Login zajęty!</h4></center>";
                }
            }
            else if(isset($_GET['operation'])){
                 if($_GET['operation']=="success"){
                    echo "<center><h4 style='color:green'>Użytkownik dodany!</h4></center>";
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
    <script src="form-validation.js"></script>
      <script src="https://cdn.jsdelivr.net/npm/feather-icons@4.28.0/dist/feather.min.js" integrity="sha384-uO3SXW5IuS1ZpFPKugNNWqTZRRglnUJK6UAZ/gxOX80nxEkN9NcGZTftn6RzhGWE" crossorigin="anonymous"></script><script src="https://cdn.jsdelivr.net/npm/chart.js@2.9.4/dist/Chart.min.js" integrity="sha384-zNy6FEbO50N+Cg5wap8IKA4M/ZnLJgzc6w2NqACZaK0u0FXfOWRRJOnQtpZun8ha" crossorigin="anonymous"></script><script src="..\navbars\dashboard.js"></script>
  </body>
</html>
    
<?php
   }?>