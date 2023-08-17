<?php
include('konek.php');

if (isset($_POST["submit"])) {
  $username = $_POST["username"];
  $password = $_POST["password"];

  //cek username apakah ada di database atau tidak
  $result = mysqli_query($koneksi, "SELECT * FROM user WHERE username = '$username'");

  // mysqli_num_rows() untuk mengetahui ada berapa baris data yang dikembalikan
  if (mysqli_num_rows($result) === 1) {
    //cek password
    $row = mysqli_fetch_assoc($result);

    //password_verify() untuk mengecek apakah sebuah password itu sama atau tidak dengan hash nya
    //parameternya yaitu string yang belum diacak dan string yang sudah diacak
    if (password_verify($password, $row["password"])) {
      $enkripsi = enkripsi($row['iduser']);
      setcookie('pernapasan', $enkripsi, time() + 10800);

      if ($row["level"] === "admin") {
        echo "<script>
                  document.location.href='admin.php';
              </script>";
        exit;
      } elseif ($row["level"] === "user") {
        echo "<script>
                  document.location.href='user';
              </script>";
        exit;
      }
    }
  }
  $error = true;
}
?>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Document</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet"
    integrity="sha384-9ndCyUaIbzAi2FUVXJi0CjmCapSmO7SnpJef0486qhLnuZ2cdeRhO02iuK6FUUVM" crossorigin="anonymous">
  <link rel="stylesheet" href="style.css">
</head>

<body>
  <div class="content text-center">
    <div class="container">
      <h1 style="margin-top:50px; margin-button:50px;">Selamat Datang Di Sistem Pakar Diagnosa Penyakit Saluran
        Pernapasan</h1>
      <div class="row">
        <div class="col-5 me-5">
          <img class="text-start" src="img/dokter.png" style="width:370px;" alt="">
        </div>
        <div class="col-7 login mt-5">
          <form action="" method="post">
            <h4 class="mt-4">Login</h4>
            <input placeholder="Username" name="username" type="text" class="form-control mb-4">
            <input placeholder="Password" name="password" type="password" class="form-control mb-4">
            <div class="d-flex justify-content-end">
              <a type="button" data-bs-toggle="modal" data-bs-target="#staticBackdrop">
                Lupa Password?
              </a>
            </div>
            <div class="row" style="padding: 0;">
              <div class="col-2 d-flex justify-content-start">
                <a class="text-decoration-none">
                  <button name="submit" type="submit" class="btn btn-primary mb-4 me-4">Login</button>
                </a>
              </div>
              <div class="col-2 d-flex justify-content-start">
                <button class="btn btn-primary mb-4">
                  <a class="text-decoration-none text-white" href="registrasi.php">
                    Daftar
                  </a>
                </button>
              </div>
            </div>
          </form>
        </div>
      </div>
      <!-- Modal Forgot Password = Input Email -->
      <div class="modal fade" id="staticBackdrop" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
        aria-labelledby="staticBackdropLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
          <div class="modal-content">
            <div class="modal-header">
              <h1 class="modal-title fs-5 text-dark" id="staticBackdropLabel">Masukkan Email</h1>
              <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>

            <form action="sendemail.php" method="post">
              <div class="modal-body">
                <div class="mb-3">
                  <label for="email" class="form-label text-dark">Masukkan email yang
                    terdaftar</label>
                  <input type="email" class="form-control" id="email" name="email">
                </div>
              </div>

              <div class="modal-footer">
                <button type="submit" class="btn btn-primary">Pilih</button>
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Kembali</button>
              </div>
            </form>
          </div>
        </div>
      </div>
      <!-- Modal Forgot Password = Input Email Selesai -->
    </div>
  </div>

  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"
    integrity="sha384-geWF76RCwLtnZ8qwWowPQNguL3RmwHVBC9FhGdlKrxdiJJigb/j/68SIy3Te4Bkz"
    crossorigin="anonymous"></script>
  <script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.7.1/jquery.min.js"></script>
  <script>
    $(".sidebar ul li").on('click', function () {
      $(".sidebar ul li.active").removeClass("active")
      $(this).addClass("active");
    })
  </script>
</body>

</html>