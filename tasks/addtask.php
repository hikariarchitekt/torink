<?php
  include '..\assets\fun\db.php';
  include '..\assets\fun\dbd.php';
  include '..\navbars\header.php';
  include '..\navbars\head.php';
  include '..\navbars\menu.php';
  $myid = $_SESSION['userId'];
   if(isset($_SESSION['userId'])){?>

    <title>Dodaj zlecenie</title>
  </body>
    <main class="col-md-9 ms-sm-auto col-lg-10 px-md-4">
      <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
        <h1 class="h1">Dodaj Zlecenie</h1>
      </div>
      <?php
      if($myid==1 || $role_id==6){
       $areas = DB::query('SELECT * FROM area');    
       $types = DB::query('SELECT * FROM types'); 
      ?>

    <div class="col-md-7 col-lg-8">
    <div class="progress">
          <div class="progress-bar" role="progressbar" aria-label="Segment one - default example" style="width: 50%" aria-valuenow="50" aria-valuemin="0" aria-valuemax="100"></div>
          <div class="progress-bar progress-bar-striped progress-bar-animated bg-success" role="progressbar" aria-label="Segment two - animated striped success example" style="width: 100%" aria-valuenow="10" aria-valuemin="0" aria-valuemax="100"></div>
        </div>
            <h1 class="h4">Forlumarz:</h1>
        <form action="..\assets\fun\addnewtask.php" method="post">
          <div class="row g-3">
            <div class="col-md-6">
              <label for="country" class="form-label">Rejon</label>
              <select class="form-select" name="area" required>
                <option value="">Wybierz...</option>
                 <?php foreach ($areas as $a) {
                     echo '<option value='.$a['area_id'].'>'.$a['area_name'].'</option>';}?>
              </select>
            </div>

            <div class="col-md-6">
              <label for="type" class="form-label">Typ</label>
              <select class="form-select" name="type" required>
                <option value="">Wybierz...</option>
                 <?php foreach ($types as $t) {
                     echo '<option value='.$t['type_id'].'>'.$t['name'].'</option>';}?>
              </select>
            </div>

            <div class="col-sm-4">
              <label for="place" class="form-label">Miejscowość</label>
              <input type="text" class="form-control" name="place" placeholder="" value="" minlength="3" required>
            </div>

            <div class="col-sm-4">
              <label for="street" class="form-label">Ulica</label>
              <input type="text" class="form-control" name="street" placeholder="" value="" minlength="3">
            </div>

            <div class="col-sm-4">
              <label for="number" class="form-label">Numer</label>
                <input type="text" class="form-control" name="number" placeholder="" minlength="1" required>
            </div>

            <div class="col-sm-6">
              <label for="client" class="form-label">Klient</label>
                <input type="text" class="form-control" name="client" placeholder="Imię i nazwisko lub nazwa firmy"  minlength="5" required>
            </div>

             <div class="col-sm-6">
              <label for="phone" class="form-label">Telefon kontaktowy</label>
                <input type="phone" class="form-control" name="phone" placeholder="" minlength="9" maxlength="9" required>
            </div>

            <div class="col-sm-12">
              <label for="desc" class="form-label">Opis</label>
              <input type="text" class="form-control" name="desc" placeholder="" minlength="3" maxlength="250" >
            </div>

             <button class="w-100 btn btn-primary btn-lg" type="submit" name="addtask-submit">Dodaj</button>
        </form>
   <?php
               if(isset($_GET['error'])){
                if($_GET['error']=="emptyform"){
                    echo "<center><h4 style='color:red'>Uzupełnij formularz!</h4></center>";
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