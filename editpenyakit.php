<?php
include("konek.php");
validasi_admin();

$id = dekripsi($_COOKIE['pernapasan']);
$data_diri = query("SELECT * FROM user WHERE iduser = $id")[0];

$iddiagnosa = $_GET['id'];

$data = query("SELECT * FROM diagnosa WHERE iddiagnosa = $iddiagnosa")[0];

if (isset($_POST['submit_penyakit'])) {
  if (edit_penyakit($_POST) > 0) {
    update_field($_POST);
    echo "
                <script>
                alert('Data Berhasil Diubah');
                document.location.href='penyakit.php';
                </script>
            ";
  } else {
    echo "
                <script>
                alert('Data Gagal Diubah');
                document.location.href='penyakit.php';
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
        <img src="img/<?= $data_diri['foto']; ?>" style="width:50px; margin-right: auto; margin-left: auto; display:block" alt="">
        <h5 class="offcanvas-title fw-bold text-center" style="font-size: 20px" id="offcanvasLabel"><?= $data_diri['nama']; ?></h5>
      </div>
      <ul class="">
        <li class=""><a style="font-size: 17px; text-decoration: none;" href="index.php">Dashboard</a></li>
        <li class=""><a href="Riwayatdeteksi.php" style="font-size: 17px; text-decoration: none;">Riwayat Deteksi</a>
        </li>
        <li class=""><a href="Pertanyaan.php" style="font-size: 17px; text-decoration: none;">Pertanyaan dan Jawaban</a>
        </li>
        <li class=""><a href="gejala.php" style="font-size: 17px; text-decoration: none;">Data Gejala</a></li>
        <li class="active"><a href="penyakit.php" style="font-size: 17px; text-decoration: none;">Penyakit dan Solusi
          </a></li>
        <li class=""><a href="datapengguna.php" style="font-size: 17px; text-decoration: none;">Data Pengguna</a></li>
        <li class=""><a href="datadiri.php" style="font-size: 17px; text-decoration: none;">Data Diri</a></li>
        <li class=""><a href="keluar.php" style="font-size: 17px; text-decoration: none;">Keluar</a></li>
      </ul>
    </div>
    <div class="content" style="width:80%;">
      <div class="container" style="padding-left: 35px; padding-right: 20px;">
        <h1 style="text-align:center; margin-top: 30px; color: black; padding: 0px 35px">Edit Data Penyakit dan Solusi
        </h1>
        <form action="" method="post">
          <input type="hidden" name="iddiagnosa" value="<?= $data['iddiagnosa']; ?>">
          <input type="hidden" name="oldpenyakit" value="<?= $data['nama_diagnosa']; ?>">
          <input type="hidden" name="oldkode" value="<?= $data['kode_diagnosa']; ?>">

          <div class="mb-3">
            <label class="form-label">Penyakit</label>
            <input type="text" class="form-control" value="<?= $data['nama_diagnosa']; ?>" name="nama_penyakit">
          </div>
          <div class="mb-3">
            <label class="form-label">Kode Penyakit</label>
            <input type="text" class="form-control" value="<?= $data['kode_diagnosa']; ?>" name="kode">
          </div>
          <div class="mb-3">
            <label class="form-label">Deskripsi</label>
            <textarea name="deskripsi" id="" cols="30" rows="10" class="form-control"><?= $data['deskripsi']; ?></textarea>
          </div>

          <button type="submit" class="btn btn-primary" name="submit_penyakit">Update</button>
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