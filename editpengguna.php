<?php
include("konek.php");

$iduser = $_GET['id'];

$data = query("SELECT * FROM user WHERE iduser = $iduser")[0];

if ($data['jk'] == "L") {
  $jk = "Laki-Laki";
} else {
  $jk = "Perempuan";
}

if (isset($_POST['submit'])) {
  if (edit_pengguna($_POST) > 0) {
    echo "
                <script>
                alert('Data Berhasil Diubah');
                document.location.href='datapengguna.php';
                </script>
            ";
  } else {
    echo "
                <script>
                alert('Data Gagal Diubah');
                document.location.href='datapengguna.php';
                </script>
            ";
  }
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
  <div class="main-container d-flex">
    <div class="sidebar px-3 pt-3">
      <div class="header pb-3">
        <img src="img/admin.png" style="width:50px; margin-right: auto; margin-left: auto; display:block" alt="">
        <h5 class="offcanvas-title fw-bold text-center" style="font-size: 20px" id="offcanvasLabel">ADMIN</h5>
      </div>
      <ul class="">
        <li class=""><a style="font-size: 17px; text-decoration: none;" href="index.php">Dashboard</a></li>
        <li class=""><a href="Riwayatdeteksi.php" style="font-size: 17px; text-decoration: none;">Riwayat Deteksi</a>
        </li>
        <li class=""><a href="Pertanyaan.php" style="font-size: 17px; text-decoration: none;">Pertanyaan dan Jawaban</a>
        </li>
        <li class=""><a href="gejala.php" style="font-size: 17px; text-decoration: none;">Data Gejala</a></li>
        <li class=""><a href="penyakit.php" style="font-size: 17px; text-decoration: none;">Penyakit dan Solusi </a>
        </li>
        <li class="active"><a href="datapengguna.php" style="font-size: 17px; text-decoration: none;">Data Pengguna</a>
        </li>
        <li class=""><a href="datadiri.php" style="font-size: 17px; text-decoration: none;">Data Diri</a></li>
        <li class=""><a href="keluar.php" style="font-size: 17px; text-decoration: none;">Keluar</a></li>
      </ul>
    </div>
    <div class="content" style="width:80%;">
      <div class="container" style="padding-left: 35px; padding-right: 20px;">
        <h1 style="text-align:center; margin-top: 30px; color: black; padding: 0px 35px">Edit Data Pengguna</h1>
        <form action="" method="post">
          <input type="hidden" name="iduser" value="<?= $data['iduser']; ?>">
          <input type="hidden" name="oldusername" value="<?= $data['username']; ?>">
          <input type="hidden" name="oldpassword" value="<?= $data['password']; ?>">
          <input type="hidden" name="oldemail" value="<?= $data['email']; ?>">
          <div class="mb-3">
            <label class="form-label">Nama</label>
            <input type="text" class="form-control" value="<?= $data['nama']; ?>" name="nama">
          </div>
          <div class="mb-3">
            <label class="form-label">Username</label>
            <input type="text" class="form-control" value="<?= $data['username']; ?>" name="username">
          </div>
          <div class="mb-3">
            <label class="form-label">Password</label>
            <input type="password" class="form-control" value="<?= $data['password']; ?>" name="password">
          </div>
          <div class="mb-3">
            <label class="form-label">Konfirmasi Password</label>
            <input type="password" class="form-control" value="<?= $data['password']; ?>" name="password2">
          </div>
          <div class="mb-3">
            <label class="form-label">Email</label>
            <input type="email" class="form-control" value="<?= $data['email']; ?>" name="email">
          </div>
          <div class="mb-3">
            <label class="form-label">Jenis Kelamin</label>
            <select class="form-select" name="jk" aria-label="Default select example" name="jk">
              <option selected hidden>
                <?= $data['jk']; ?>
              </option>
              <option value="P">Perempuan</option>
              <option value="L">Laki-Laki</option>
            </select>
          </div>
          <div class="mb-3">
            <label class="form-label">Level</label>
            <input type="text" class="form-control" value="<?= $data['level']; ?>" name="level">
          </div>
          <button type="submit" class="btn btn-primary" name="submit">Update</button>
        </form>
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