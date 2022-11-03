<?php
  include '..\assets\fun\db.php';
  include '..\assets\fun\dbd.php';
  include '..\navbars\header.php';
  include '..\navbars\head.php';
  include '..\navbars\menu.php';
  $myid = $_SESSION['userId'];
   if(isset($_SESSION['userId'])){
   $areas = DB::query('SELECT * FROM area');    
   $roles = DB::query('SELECT * FROM roles');
   $states = DB::query('SELECT * FROM states');    
   ?>

    <title>Pokaż pracowników</title>
  </body>
    <main class="col-md-9 ms-sm-auto col-lg-10 px-md-4">
      <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
        <h1 class="h1">Pokaż pracowników</h1>
        
      </div>
      
   <h1 class="h4">Krytera:</h1>
<div class="col-md-7 col-lg-8">
        <form class="needs-validation" action="..\assets\fun\findusers.php" method="post">
          <div class="row g-3">
            <div class="col-sm-2">
              <label for="firstName" class="form-label">Imię</label>
              <input type="text" class="form-control" name="firstName" placeholder="" value="" minlength="3">
            </div>

            <div class="col-sm-2">
              <label for="lastName" class="form-label">Nazwisko</label>
              <input type="text" class="form-control" name="lastName" placeholder="" value="" minlength="3">
            </div>
      
            <div class="col-md-2">
              <label for="country" class="form-label">Rejon</label>
              <select class="form-select" name="area" >
                <option value="">Wybierz...</option>
                 <?php foreach ($areas as $a) {
                     echo '<option value='.$a['area_id'].'>'.$a['area_name'].'</option>';}?>
              </select>
              <div class="invalid-feedback">
                Wybierz rejon!
              </div>
            </div>

            <div class="col-md-2">
              <label for="state" class="form-label">Rola</label>
              <select class="form-select" name="role" >
                <option value="">Wybierz...</option>
                 <?php foreach ($roles as $r) {
                     echo '<option value='.$r['role_id'].'>'.$r['role_name'].'</option>';}?>
              </select>
              <div class="invalid-feedback">
                Wybierz rolę!
              </div>
            </div>

            <div class="col-md-2">
              <label for="state" class="form-label">Status</label>
              <select class="form-select" name="state" >
                <option value="">Wybierz...</option>
                 <?php foreach ($states as $s) {
                     echo '<option value='.$s['state_id'].'>'.$s['state'].'</option>';}?>
              </select>
              <div class="invalid-feedback">
                Wybierz status!
              </div>

            </div>
               <div class="col-md-2">
               <br>
               
               <button class="btn btn-primary btn-lg" type="submit" name="finduser-submit">Znajdź</button>
               </div>
        </form>
   <?php
                  if(isset($_GET['msg'])){

                    echo "<center><h4 style='color:red'>Podaj kryteria wyszukiwania!</h4></center>";
                  }
                elseif(isset($_GET['all'])){
                    $fname = $_GET['userfname'];
                    $lname = $_GET['userlname'];
                    $area = $_GET['area'];
                    $role = $_GET['role'];
                    $state = $_GET['state'];
                    
                    $finduser = DB::query('SELECT * FROM users, roles, area, states 
                    WHERE users.role_id=roles.role_id
                    AND users.area_id=area.area_id
                    AND users.state_id=states.state_id
                    AND (:fn="" OR users.name = :fn) 
                    AND (:sn="" OR users.second_name = :sn) 
                    AND (:area="" OR users.area_id = :area)
                    AND (:rola="" OR users.role_id = :rola)  
                    AND (:status="" OR users.state_id = :status);', 
                    array(':fn'=>$fname, ':sn'=>$lname, ':area'=>$area, ':rola'=>$role, ':status'=>$state));
                    if(!$finduser){
                        echo "<center><h4 style='color:red'>Brak takiego pracownika!</h4></center>";
                    }
                    else{
                        echo '<table class="table table-sm table-bordered">
                              <thead>
                              <tr>
                                <th scope="col">ID</th>
                                <th scope="col">Imie</th>
                                <th scope="col">Nazwisko</th>
                                <th scope="col">Nazwa użytkownika</th>
                                <th scope="col">Email</th>
                                <th scope="col">Telefon</th>
                                <th scope="col">Rola</th>
                                <th scope="col">Obszar</th>
                                <th scope="col">Status</th>
                              </tr>
                              </thead>
                              <tbody>';
                              foreach ($finduser as $un) {
                                echo '<tr>
                                        <th scope="col">'.$un['user_id'].'</th>
                                        <th scope="col">'.$un['name'].'</th>
                                        <th scope="col">'.$un['second_name'].'</th>
                                        <th scope="col">'.$un['user_name'].'</th>
                                        <th scope="col">'.$un['mail'].'</th>
                                        <th scope="col">'.$un['phone'].'</th>
                                        <th scope="col">'.$un['role_name'].'</th>
                                        <th scope="col">'.$un['area_name'].'</th>
                                        <th scope="col">'.$un['state'].'</th>
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