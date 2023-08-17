<?php
require_once 'konek.php';
$id = dekripsi($_COOKIE['pernapasan']);

$data_diri = query("SELECT * FROM user WHERE iduser = $id")[0];

if ($data_diri['jk'] == "L") {
  $jenis_kelamim = "Laki-Laki";
} else {
  $jenis_kelamim = "Perempuan";
}

if (isset($_POST['submit'])) {
  if (update_datadiri($_POST) > 0) {
    echo "
                  <script>
                  alert('Data Diri Berhasil Diubah');
                  document.location.href='datadiri.php';
                  </script>
              ";
  } else {
    echo "
                  <script>
                  alert('Data Diri Gagal Diubah');
                  document.location.href='datadiri.php';
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
        <form action="" method="post" enctype="multipart/form-data">
          <input type="hidden" name="iduser" value="<?= $data_diri['iduser']; ?>">
          <input type="hidden" name="oldusername" value="<?= $data_diri['username']; ?>">
          <input type="hidden" name="oldpassword" value="<?= $data_diri['password']; ?>">
          <div class="profil text-center mt-4">
            <img src="img/admin.png" alt="" style="width:100px;">

            <div class="mb-3 mt-2">
              <input style="width: 250px; margin-left: 37%;" class="form-control" type="file" id="formFile">
            </div>
          </div>

          <div class="mb-3">
            <label for="exampleInputEmail1" class="form-label">Nama</label>
            <input type="text" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp"
              value="<?= $data_diri['nama']; ?>" name="nama">
          </div>

          <div class="mb-3">
            <label for="exampleInputEmail1" class="form-label">Username</label>
            <input type="text" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp"
              value="<?= $data_diri['username']; ?>" name="username">
          </div>

          <div class="mb-3">
            <label for="exampleInputEmail1" class="form-label">Email</label>
            <input type="email" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp"
              value="<?= $data_diri['email']; ?>" name="email">
          </div>

          <div class="mb-3">
            <label for="exampleInputPassword1" class="form-label">Password</label>
            <input type="password" class="form-control" id="exampleInputPassword1"
              value="<?= $data_diri['password']; ?>" name="password">
          </div>

          <div class="mb-3">
            <label for="exampleInputEmail1" class="form-label">Konfirmasi Password</label>
            <input type="password" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp"
              value="<?= $data_diri['password']; ?>" name="password2">
          </div>

          <div class="mb-3">
            <label for="exampleInputEmail1" class="form-label">Jenis Kelamin</label>
            <select class="form-select" aria-label="Default select example" name="jk">
              <option value="<?= $data_diri['jk']; ?>" selected hidden><?= $jenis_kelamim; ?></option>
              <option value="P">Perempuan</option>
              <option value="L">Laki-Laki</option>
            </select>
          </div>
          <button type="submit" class="btn btn-primary" name="submit">Submit</button>
        </form>
      </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"
      integrity="sha384-geWF76RCwLtnZ8qwWowPQNguL3RmwHVBC9FhGdlKrxdiJJigb/j/68SIy3Te4Bkz"
      crossorigin="anonymous"></script>
    <script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.7.1/jquery.min.js"></script>

</body>

</html>