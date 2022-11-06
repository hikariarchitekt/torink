<!doctype html>
<?php
  require_once 'assets\fun\db.php';
  require_once 'assets\fun\dbd.php';
  ?>

  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Logowanie</title>

    <link rel="canonical" href="https://getbootstrap.com/docs/5.2/examples/sign-in/">
    <script>
    function showPass() {
      var x = document.getElementById("floatingPassword");
      if (x.type === "password") {
        x.type = "text";
      } else {
        x.type = "password";
      }
}
    </script>

<link href="/assets/dist/css/bootstrap.min.css" rel="stylesheet">

    <style>
      .bd-placeholder-img {
        font-size: 1.125rem;
        text-anchor: middle;
        -webkit-user-select: none;
        -moz-user-select: none;
        user-select: none;
      }

      @media (min-width: 768px) {
        .bd-placeholder-img-lg {
          font-size: 3.5rem;
        }
      }

      .b-example-divider {
        height: 3rem;
        background-color: rgba(0, 0, 0, .1);
        border: solid rgba(0, 0, 0, .15);
        border-width: 1px 0;
        box-shadow: inset 0 .5em 1.5em rgba(0, 0, 0, .1), inset 0 .125em .5em rgba(0, 0, 0, .15);
      }

      .b-example-vr {
        flex-shrink: 0;
        width: 1.5rem;
        height: 100vh;
      }

      .bi {
        vertical-align: -.125em;
        fill: currentColor;
      }

      .nav-scroller {
        position: relative;
        z-index: 2;
        height: 2.75rem;
        overflow-y: hidden;
      }

      .nav-scroller .nav {
        display: flex;
        flex-wrap: nowrap;
        padding-bottom: 1rem;
        margin-top: -1px;
        overflow-x: auto;
        text-align: center;
        white-space: nowrap;
        -webkit-overflow-scrolling: touch;
      }
    </style>

    <link href="sign-in/signin.css" rel="stylesheet">
  </head>
  <body class="text-center">
    
<main class="form-signin w-100 m-auto">
  <form action="\assets\fun\logincorrect.php" method="post">
    <img class="mb-4" src="/assets/brand/logo.svg" alt="" width="100" height="80">
    <h1 class="h3 mb-3 fw-normal">Podaj dane:</h1>

    <div class="form-floating">
      <input type="login" class="form-control" id="floatingInput" name="name" placeholder="Podaj nazwę użytkownika" minlength="3">
      <label for="floatingInput">Login</label>
    </div>
    <div class="form-floating">
      <input type="password" class="form-control" id="floatingPassword" name="pwd" placeholder="Podaj hasło" minlength="8">
      <label for="floatingPassword">Hasło</label>
      <input type="checkbox" onclick="showPass()">Pokaż hasło
    </div>

     <?php
          if(isset($_SESSION['userId'])){
              header('Location: dashboard/index.html');
          }
          else{
            if(isset($_GET['error'])){
                if($_GET['error']=="emptyfileds"){
                    echo '<p class="error">Uzupełnij wszystkie pola!</p><br>';
                }
                else if($_GET['error']=="wrongpass"){
                    echo '<p class="error">Błędne hasło!</p><br>';
                }
                else if($_GET['error']=="nouser"){
                    echo '<p class="error">Brak użytkownika o podanej nazwie!</p><br>';
                }
            }
            else if(isset($_GET['operation'])){
                 if($_GET['operation']=="success"){
                    header("Location: dashboard/index.php");

                }
            }
          }
        ?>
    <button class="w-100 btn btn-lg btn-primary" type="submit" name="login-submit">Zaloguj się</button>
    <p class="mt-5 mb-3 text-muted">&copy; 2022-2023</p>
  </form>
  

</main>

  </body>
</html>
