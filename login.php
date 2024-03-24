<?php
  session_start();
  include_once 'koneksi.php';
  if(!isset($_SESSION['log'])){

  }else{
    header('location:index.php');
  }

  if(isset($_POST['login'])){
    $user = mysqli_real_escape_string($koneksi, $_POST['username']);
    $pass = mysqli_real_escape_string($koneksi, $_POST['password']);
    $queryuser = mysqli_query($koneksi, "SELECT * FROM login WHERE username='$user'");
    $cariuser = mysqli_fetch_assoc($queryuser);
    if(password_verify($pass, $cariuser['password'])){
      $_SESSION['userid'] = $cariuser['id'];
      $_SESSION['username'] = $cariuser['username'];
      $_SESSION['log'] = 'login';

      if($cariuser){
        echo '<script>
          alert("Anda berhasil login!");window.location="index.php"
        </script>';
      }else{
        echo '<script>
          alert("Data yang anda masukkan salah!");history.go(-1);
        </script>';
      }
    }else{
      echo '<script>
          alert("Username atau Password yang anda masukkan salah!");history.go(-1);
        </script>';
    }
  };
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Absensi Mahasiswa</title>
    <!-- cdn boostrap -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <!-- icon -->
    <link rel="shortcut icon" href="img/unwir.png">
    <!-- my css -->
    <link rel="stylesheet" href="style.css">
    <!-- icon fontawesome -->
    <script src="https://kit.fontawesome.com/df3c5d40bc.js" crossorigin="anonymous"></script>
</head>
<body>
    <section>
        <div class="container mt-5">
            <div class="row justify-content-center">
              <div class="col-md-6">
                <div class="card">
                  <div class="card-header text-center">
                    LOGIN
                  </div>
                  <div class="card-body">
                    <form method="POST">
                      <div class="mb-3">
                        <label for="username" class="form-label">Username</label>
                        <input type="text" class="form-control" id="username" name="username" placeholder="Enter your username">
                      </div>
                      <div class="mb-3">
                        <label for="password" class="form-label">Password</label>
                        <input type="password" class="form-control" id="password" name="password" placeholder="Enter your password">
                      </div>
                      <div class="d-grid gap-2 mx-auto">
                        <button class="btn btn-primary" type="submit" name="login">Masuk</button>
                      </div>
                    </form>
                  </div>
                </div>
              </div>
            </div>
          </div>
    </section>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
</body>
</html>