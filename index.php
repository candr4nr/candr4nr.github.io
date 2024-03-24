<?php
  session_start();
  include_once "koneksi.php";

  if($_SESSION['log'] != "login"){
    header('location:login.php');
  }
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
  <!-- navbar -->
    <section>
      <nav class="navbar bg-body-tertiary sticky-top">
        <div class="container-fluid">
          <a class="navbar-brand komputer" href="#">TEKNIK <span>KOMPUTER</span></a>
          <button class="navbar-toggler" type="button" data-bs-toggle="offcanvas" data-bs-target="#offcanvasNavbar" aria-controls="offcanvasNavbar" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
          </button>
          <div class="offcanvas offcanvas-end" tabindex="-1" id="offcanvasNavbar" aria-labelledby="offcanvasNavbarLabel">
            <div class="offcanvas-header">
              <h5 class="offcanvas-title" id="offcanvasNavbarLabel">Absensi Mahasiswa</h5>
              <button type="button" class="btn-close" data-bs-dismiss="offcanvas" aria-label="Close"></button>
            </div>
            <div class="offcanvas-body">
              <ul class="navbar-nav justify-content-end flex-grow-1 pe-3">
                <li class="nav-item">
                  <a class="nav-link active" aria-current="page" href="#"><i class="fa-solid fa-check-to-slot fa-lg"></i>Absensi</a>
                </li>
                <li class="nav-item">
                  <a class="nav-link" href="https://docs.google.com/spreadsheets/d/1dEM0IZwEpDNpbMjshgJojRbIpwxF7lCnstp0ogU7S-M/edit?usp=sharing" target="_blank"><i class="fa-solid fa-file fa-lg"></i>Laporan</a>
                </li>
                <li class="nav-item">
                  <a class="nav-link" href="logout.php"><i class="fa-solid fa-right-from-bracket fa-lg"></i>Logout</a>
                </li>
              </ul>
            </div>
          </div>
        </div>
      </nav>
    </section>
    <!-- end of navbar -->
    <!-- alert -->
    
    <!-- end of alert -->
    <!-- input form -->
    <section>
      <div class="container mt-4">
        <div class="row justify-content-center">
          <div class="alert alert-success alert-dismissible fade show col-md-8 d-none my-alert" role="alert">
            <strong>Terimakasih!</strong> Data anda sudah kami terima.
          <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
        <div class="card card-form col-md-8 p-3">
              <h4>Formulir Kehadiran Mahasiswa</h4>
              <p>Teknik Komputer Universitas Wiralodra</p>
            </div>
        </div>
      </div>
      <div class="container">
        <div class="row justify-content-center">
          <div class="card col-md-8 mt-3 card-form p-3">
            <form name="submit-to-google-sheet" class="row g-3">
              <div class="col-md-12 input-mhs">
              <label for="nim" class="form-label">NIM <span class="required">*</span></label>
              <input name="nim" class="form-control" type="number" placeholder="NIM" required>
              </div>
              <div class="col-md-12 input-mhs">
              <label for="nama" class="form-label">Nama Lengkap <span class="required">*</span></label>
              <input name="nama" class="form-control" type="text" placeholder="Nama" required>
              </div>
              <button type="submit" class="btn btn-primary col-md-2 my-2 mt-3 btn-kirim">Kirim</button>
              <button class="btn btn-primary col-md-2 my-2 mt-3 d-none btn-loading" type="button" disabled>
                <span class="spinner-border spinner-border-sm" aria-hidden="true"></span>
                <span role="status">Loading...</span>
              </button>
            </form>
            <p class="mt-2">Jangan pernah mengirimkan sandi di formulir.</p>
          </div>
        </div>
      </div>
    </section>

    <section>
      <footer class="bg-body-tertiary text-center mt-4">
        <!-- Copyright -->
        <div class="text-center p-3">
          <p><a href="#">Laporkan Penyalahgunaan - Persyaratan Layanan - Kebijakan Privasi</a></p>
          <p>© 2024 Copyright:<a class="text-body" href="#"> KELOMPOK 2</a></p>
        </div>
        <!-- Copyright -->
      </footer>
    </section>
    <script>
        const scriptURL = 'https://script.google.com/macros/s/AKfycbzG-QnJVqSWX0KV8ZL6E0-jzPRt-Dru5XTUzQWUjHRinhLDQLolK_rGcRpGzG_FMJwP/exec'
        const form = document.forms['submit-to-google-sheet']
        const btnKirim = document.querySelector('.btn-kirim');
        const btnLoading = document.querySelector('.btn-loading');
        const myAlert = document.querySelector('.my-alert')
      
        form.addEventListener('submit', e => {
          e.preventDefault();
          
          btnLoading.classList.toggle('d-none');
          btnKirim.classList.toggle('d-none');
          fetch(scriptURL, { method: 'POST', body: new FormData(form)})
            .then(response => {
              btnLoading.classList.toggle('d-none');
              btnKirim.classList.toggle('d-none');

              myAlert.classList.toggle('d-none');

              form.reset();
              console.log('Success!', response);
            })
            .catch(error => console.error('Error!', error.message))
        });
      </script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
</body>
</html>