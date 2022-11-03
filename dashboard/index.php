<?php
  include '..\assets\fun\db.php';
  include '..\assets\fun\dbd.php';
  include '..\navbars\header.php';
  include '..\navbars\head.php';
  include '..\navbars\menu.php';
  $myid = $_SESSION['userId'];
  $myname = $_SESSION['username'];
  $my2name = $_SESSION['user2name'];
  if(isset($_SESSION['userId'])){?>
        <title>Home</title>
  </body>
    <main class="col-md-9 ms-sm-auto col-lg-10 px-md-4">
      <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
        <h1 class="h1">Witaj  <?php echo $myname.' '.$my2name.'!' ?></h1>
        
      </div>
      <?php

      if($myrole=='admin'){
        echo '<h4>Dzień jak co dzień wiesz co robić. Powodzenia! :)</h4>';
      }
      elseif($myrole=='kierownik'){
        echo '<h5>Sprawdź dzisiejsze zlecenia wybierając pozycje "Zlecenia".<br>
              Zarządzaj swoimi pracownikami oraz podejrzyj ich status w zakładce "Pracownicy".<br>
              Możesz również przeglądać posiadane przedmioty pracowników oraz swoje przechodząc do opcji "Magazyn".<br>
              Wszystkie dostępne podsumowania znajdzieś w panelu "Raporty"
              </h5';
      }
      elseif($myrole=='dyspozytor'){
        $userstate = DB::query('SELECT state_id FROM users WHERE user_id=:usid', array(':usid'=>$myid))[0]['state_id'];
        if($userstate==4){
          echo '
          <form action="..\assets\fun\updateworkstate.php" method="post">
          <input type="hidden" name="myid" value="'.$myid.'" />
          <input type="hidden" name="start" value="3" />
          <h4><button type="submit" class="btn btn-success" name="stateupdate-submit">Rozpocznij pracę</button> , aby kontynuować!</h4>';
        }

        elseif($userstate==3){
          echo '
          <form action="..\assets\fun\updateworkstate.php" method="post">
          <input type="hidden" name="myid" value="'.$myid.'" />
          <input type="hidden" name="stop" value="4" />
          <h4>Naciśnij <button type="submit" class="btn btn-secondary" name="stateupdate-submit">Koniec pracy</button> , aby zakończyć dzień!</h4>

          <h5>
          Zaplanuj swój dzień pracy wybierając z lewego panelu pozycję "Zlecenia"!<br>
          Z poziomu panelu "Zlecenia", przypisz zadania do wykonania dla techników.<br>
          </h5>';
        }
      }

      elseif($myrole=='magazynier'){
        $userstate = DB::query('SELECT state_id FROM users WHERE user_id=:usid', array(':usid'=>$myid))[0]['state_id'];
        if($userstate==4){
          echo '
          <form action="..\assets\fun\updateworkstate.php" method="post">
          <input type="hidden" name="myid" value="'.$myid.'" />
          <input type="hidden" name="start" value="3" />
          <h4><button type="submit" class="btn btn-success" name="stateupdate-submit">Rozpocznij pracę</button> , aby kontynuować!</h4>';
        }

        elseif($userstate==3){
          echo '
          <form action="..\assets\fun\updateworkstate.php" method="post">
          <input type="hidden" name="myid" value="'.$myid.'" />
          <input type="hidden" name="stop" value="4" />
          <h4>Naciśnij <button type="submit" class="btn btn-secondary" name="stateupdate-submit">Koniec pracy</button> , aby zakończyć dzień!</h4>
          
          <h5>
          Zarządzaj sprzętem i narzędziami na stanie wybierając z lewego panelu pozycję "Magazyn"!<br>
          </h5>';
        }
      }

      elseif($myrole=='technik'){
        $userstate = DB::query('SELECT state_id FROM users WHERE user_id=:usid', array(':usid'=>$myid))[0]['state_id'];
        if($userstate==4){
          echo '
          <form action="..\assets\fun\updateworkstate.php" method="post">
          <input type="hidden" name="myid" value="'.$myid.'" />
          <input type="hidden" name="start" value="3" />
          <h4><button type="submit" class="btn btn-success" name="stateupdate-submit">Rozpocznij pracę</button> , aby kontynuować!</h4>';
        }

        elseif($userstate==3){
          $userstate = DB::query('SELECT state_id FROM users WHERE user_id=:usid', array(':usid'=>$myid))[0]['state_id'];
          echo '
          <form action="..\assets\fun\updateworkstate.php" method="post">
          <input type="hidden" name="myid" value="'.$myid.'" />
          <input type="hidden" name="stop" value="4" />
          <h4>Naciśnij <button type="submit" class="btn btn-secondary" name="stateupdate-submit">Koniec pracy</button> , aby zakończyć dzień!</h4>
          
          <h5>
          Sprawdź zadania na dziś oraz modyfikuj ich status wybierając pozycję "Zlecenia"!<br>
          Możesz również zobaczyć przypisany do Ciebie sprzęt przechodząc do panelu "Magazyn"
          </h5>';
        }
      }

      elseif($myrole=='zleceniodawca'){
        echo '<h4>Dodawaj nowe zlecenia, zgłaszaj usterki oraz awarie w zakładce "Zlecenia"!</h4>';
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
    
<?php }?>