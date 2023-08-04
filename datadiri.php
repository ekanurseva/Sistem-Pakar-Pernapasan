<?php
include("konek.php");

$iduser = $_GET['id'];

$data = query("SELECT * FROM user WHERE iduser = $iduser")[0];

if ($data['jk'] == "L") {
  $jk = "Laki-Laki";
} else {
  $jk = "Perempuan";
}

if (isset($_POST['submit_profil'])) {
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
        <li class=""><a style="font-size: 17px; text-decoration: none;" href="admin.php">Dashboard</a></li>
        <li class=""><a href="riwayatdeteksi.php" style="font-size: 17px; text-decoration: none;">Riwayat Deteksi</a>
        </li>
        <li class=""><a href="pertanyaan.php" style="font-size: 17px; text-decoration: none;">Pertanyaan dan Jawaban</a>
        </li>
        <li class=""><a href="gejala.php" style="font-size: 17px; text-decoration: none;">Data Gejala</a></li>
        <li class=""><a href="penyakit.php" style="font-size: 17px; text-decoration: none;">Penyakit dan Solusi </a>
        </li>
        <li class=""><a href="datapengguna.php" style="font-size: 17px; text-decoration: none;">Data Pengguna</a></li>
        <li class="active"><a href="datadiri.php" style="font-size: 17px; text-decoration: none;">Data Diri</a></li>
        <li class=""><a href="keluar.php" style="font-size: 17px; text-decoration: none;">Keluar</a></li>
      </ul>
    </div>
    <div class="content" style="width:80%;">
      <div class="container" style="padding-left: 35px; padding-right: 20px;">
        <h1 style="text-align:center; margin-top: 30px; color: black; padding: 0px 35px">Data Diri</h1>
        <form>
          <div class="profil text-center mt-4">
            <img src="img/admin.png" alt="" style="width:100px;">
            <div class="mb-3 mt-2">
              <input style="width: 250px; margin-left: 37%;" class="form-control" type="file" id="formFile">
            </div>
          </div>
          <div class="mb-3">
            <label for="nama" class="form-label">Nama</label>
            <input type="text" class="form-control" id="nama" value="<?= $data['nama']; ?>" name="nama">
          </div>
          <div class="mb-3">
            <label for="username" class="form-label">Username</label>
            <input type="text" class="form-control" id="username" value="<?= $data['username']; ?>" name="username">
          </div>
          <div class="mb-3">
            <label for="email" class="form-label">Email</label>
            <input type="email" class="form-control" id="email" value="<?= $data['email']; ?>" name="email">
          </div>
          <div class="mb-3">
            <label for="password" class="form-label">Password</label>
            <input type="password" class="form-control" value="<?= $data['password']; ?>" id="password" name="password">
            <div class="mb-3">
              <label for="password2" class="form-label">Konfirmasi Password</label>
              <input type="password" class="form-control" value="<?= $data['password']; ?>" id="password2"
                name="password2">
            </div>
            <div class="mb-3">
              <label for="tlp" class="form-label">Telepon</label>
              <input type="text" class="form-control" id="tlp" value="<?= $data['telepon']; ?>" name="telepon">
            </div>
            <div class="mb-3">
              <label for="tgl" class="form-label">Tanggal Lahir</label>
              <input type="date" class="form-control" id="tgl" value="<?= $data['tgl_lahir']; ?>" name="tgl_lahir">
            </div>
            <div class="mb-3">
              <label for="jk" class="form-label">Jenis Kelamin</label>
              <select id="jk" class="form-select" name="jk" aria-label="Default select example">
                <option selected hidden>
                  <?= $data['jk']; ?>
                </option>
                <option value="1">Perempuan</option>
                <option value="2">Laki-Laki</option>
              </select>
            </div>
          </div>
          <button type="submit" name="submit_profil" class="btn btn-primary">Submit</button>
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