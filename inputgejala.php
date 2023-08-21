<?php
include("konek.php");
validasi_admin();

$id = dekripsi($_COOKIE['pernapasan']);
$data_diri = query("SELECT * FROM user WHERE iduser = $id")[0];

$iddiagnosa = $_POST['diagnosa'];
$kode = get_kode_gejala($iddiagnosa);

$data_diagnosa = query("SELECT * FROM diagnosa WHERE iddiagnosa = $iddiagnosa")[0];

if (isset($_POST["submit_gejala"])) {
  if (create_gejala($_POST) > 0) {
    echo " 
      <script>
      alert('Data Gejala Berhasil Ditambah');
      document.location.href='gejala.php';
      </script>
      ";
  } else {
    echo "<script>
      alert('Data Gejala Gagal Ditambah');
      </script>";
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
        <img src="img/<?= $data_diri['foto']; ?>"
          style="width:50px; margin-right: auto; margin-left: auto; display:block" alt="">
        <h5 class="offcanvas-title fw-bold text-center" style="font-size: 20px" id="offcanvasLabel">
          <?= $data_diri['nama']; ?>
        </h5>
      </div>
      <ul class="">
        <li class=""><a style="font-size: 17px; text-decoration: none;" href="index.php">Dashboard</a></li>
        <li class=""><a href="Riwayatdeteksi.php" style="font-size: 17px; text-decoration: none;">Riwayat Deteksi</a>
        </li>
        <li class=""><a href="Pertanyaan.php" style="font-size: 17px; text-decoration: none;">Data Jawaban</a>
        </li>
        <li class="active"><a href="gejala.php" style="font-size: 17px; text-decoration: none;">Data Gejala</a></li>
        <li class=""><a href="penyakit.php" style="font-size: 17px; text-decoration: none;">Penyakit dan Solusi </a>
        </li>
        <li class=""><a href="datapengguna.php" style="font-size: 17px; text-decoration: none;">Data Pengguna</a></li>
        <li class=""><a href="datadiri.php" style="font-size: 17px; text-decoration: none;">Data Diri</a></li>
        <li class=""><a href="keluar.php" style="font-size: 17px; text-decoration: none;">Keluar</a></li>
      </ul>
    </div>
    <div class="content" style="width:80%;">
      <div class="container" style="padding-left: 35px; padding-right: 20px;">
        <h1 style="text-align:center; margin-top: 30px; color: black; padding: 0px 35px">Insert Data Gejala</h1>
        <form action="" method="post">
          <input type="hidden" name="diagnosa" id="" value="<?= $iddiagnosa; ?>">
          <div class="mb-3">
            <label class="form-label">Penyakit</label>
            <input type="text" class="form-control" name="" disabled value="<?= $data_diagnosa['nama_diagnosa']; ?>">
          </div>
          <div class="mb-3">
            <label class="form-label">Kode Gejala</label>
            <input type="text" class="form-control" name="kode_gejala" readonly value="<?= $kode; ?>">
          </div>
          <div class="mb-3">
            <label class="form-label">Gejala</label>
            <input type="text" class="form-control" name="gejala">
          </div>
          <div class="mb-3">
            <label class="form-label">Bobot</label>
            <input type="number" class="form-control" name="bobot" step="0.1" max="1">
          </div>
          <button type="submit" name="submit_gejala" class="btn btn-primary">Submit</button>
          <a href="gejala.php" class="btn btn-secondary">Kembali</a>
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