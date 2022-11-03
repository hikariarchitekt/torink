<?php
  include '..\assets\fun\db.php';
  include '..\assets\fun\dbd.php';
  include '..\navbars\header.php';
  include '..\navbars\head.php';
  include '..\navbars\menu.php';
  $myid = $_SESSION['userId'];
   if(isset($_SESSION['userId'])){?>

    <title>Status</title>
  </body>
    <main class="col-md-9 ms-sm-auto col-lg-10 px-md-4">
      <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
        <h1 class="h1">Status</h1>
      </div>
      <div class="col-md-7 col-lg-8">
        <div class="progress">
            <div class="progress-bar" role="progressbar" aria-label="Segment one - default example" style="width: 100%" aria-valuenow="100" aria-valuemin="0" aria-valuemax="100"></div>
        </div>
        <br><br>
        <div class="alert alert-success" role="alert">
          <h4 class="alert-heading">Zlecenie zostało przyjęte do systemu</h4>
          <p>Teraz zostanie ono obsłużone przez dyspozytora i wydane dla technika w dniu realizacji zlecenia.</p>
          <hr>
          <p class="mb-0">Możesz dodać kolejne zlecenie wybierając bezpośrednio przycisk na dole lub wyszukać zlecenie.</p>
        </div>

        <div class="d-flex gap-5 justify-content-center">
        <div class="col-4 col-sm-3 themed-grid-col"><a href="addtask.php"><button type="button" class="btn btn-success">Dodaj kolejne zlecenie</button></a></div>
        <div class="col-4 col-sm-3 themed-grid-col"><a href="showtasks.php"><button type="button" class="btn btn-primary">Wyświetl zlecenia</button></a></div>
      </div>

        </div>
    </main>



    <script src="../assets/dist/js/bootstrap.bundle.min.js"></script>
      <script src="https://cdn.jsdelivr.net/npm/feather-icons@4.28.0/dist/feather.min.js" integrity="sha384-uO3SXW5IuS1ZpFPKugNNWqTZRRglnUJK6UAZ/gxOX80nxEkN9NcGZTftn6RzhGWE" crossorigin="anonymous"></script><script src="https://cdn.jsdelivr.net/npm/chart.js@2.9.4/dist/Chart.min.js" integrity="sha384-zNy6FEbO50N+Cg5wap8IKA4M/ZnLJgzc6w2NqACZaK0u0FXfOWRRJOnQtpZun8ha" crossorigin="anonymous"></script><script src="..\navbars\dashboard.js"></script>
  </body>
</html>
    
<?php
   }?>