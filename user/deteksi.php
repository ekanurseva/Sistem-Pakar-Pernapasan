<?php
require_once '../konek.php';
validasi();

$id = dekripsi($_COOKIE['pernapasan']);
$user = query("SELECT * FROM user WHERE iduser = '$id'")[0];

$jumlah_pertanyaan = jumlah_data("SELECT DISTINCT nama_gejala FROM gejala");

$jumper1 = ceil($jumlah_pertanyaan / 2);
$jumper2 = $jumlah_pertanyaan - $jumper1;

$pertanyaan1 = query("SELECT DISTINCT nama_gejala FROM gejala LIMIT $jumper1");
$pertanyaan2 = query("SELECT DISTINCT nama_gejala FROM gejala LIMIT $jumper2 OFFSET $jumper1");

$jawaban = query("SELECT * FROM jawaban");

if (isset($_POST['submit'])) {
  hitung($_POST);
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
  <link rel="stylesheet" href="../style.css">
</head>

<body>
  <div class="main-container d-flex">
    <div class="sidebar px-3 pt-3">
      <div class="header pb-3">
        <img src="../img/admin.png" style="width:50px; margin-right: auto; margin-left: auto; display:block" alt="">
        <h5 class="offcanvas-title fw-bold text-center" style="font-size: 20px" id="offcanvasLabel">USER</h5>
      </div>
      <ul class="">
        <li class=""><a style="font-size: 17px; text-decoration: none;" href="index.php">Dashboard</a></li>
        <li class="active"><a href="deteksi.php" style="font-size: 17px; text-decoration: none;">Mulai Deteksi</a></li>
        <li class=""><a href="riwayatdeteksi.php" style="font-size: 17px; text-decoration: none;">Riwayat Deteksi</a>
        </li>
        <li class=""><a href="datadiri.php" style="font-size: 17px; text-decoration: none;">Data Diri</a></li>
        <li class=""><a href="../keluar.php" style="font-size: 17px; text-decoration: none;">Keluar</a></li>
      </ul>
    </div>
    <div class="content" style="width:80%;">
      <div class="container" style="padding-left: 35px; padding-right: 20px;">
        <h1 style="text-align:center; margin-top: 30px; color: black; padding: 0px 35px">Deteksi Diagnosis Penyakit
          Saluran Pernapasan</h1>
        <form action="" method="post">
          <div class="mb-3">
            <label for="exampleInputEmail1" class="form-label">Nama</label>
            <input type="email" class="form-control" value="<?php echo $user['nama']; ?>" readonly>
          </div>
          <h5>Silahkan Pilih Opsi Frekuensi Gejala yang Dialami Di Bawah untuk Mendapatkan Hasil Deteksi Penyakit dan
            Solusinya</h5>
          <div class="row">
            <div class="col-6">
              <?php
              $i = 1;
              foreach ($pertanyaan1 as $p1):
                ?>
                <h6>
                  <?= $i; ?>.
                  <?= $p1['nama_gejala']; ?>
                </h6>
                <?php foreach ($jawaban as $jawab): ?>
                  <div class="form-check">
                    <input class="form-check-input" type="radio" value="<?= $jawab['kode_jawaban']; ?>"
                      id="<?= $jawab['kode_jawaban'] . $p1['nama_gejala']; ?>" name="<?= $p1['nama_gejala']; ?>">
                    <label class="form-check-label" for="<?= $jawab['kode_jawaban'] . $p1['nama_gejala']; ?>">
                      <?= $jawab['jawaban']; ?>
                    </label>
                  </div>
                  <?php
                endforeach;
                $i++;
              endforeach;
              ?>
            </div>

            <div class="col-6">
              <?php foreach ($pertanyaan2 as $p2):
                ?>
                <h6>
                  <?= $i; ?>.
                  <?= $p2['nama_gejala']; ?>
                </h6>
                <?php foreach ($jawaban as $jawab): ?>
                  <div class="form-check">
                    <input class="form-check-input" type="radio" value="<?= $jawab['kode_jawaban']; ?>"
                      id="<?= $jawab['kode_jawaban'] . $p2['nama_gejala']; ?>" name="<?= $p2['nama_gejala']; ?>">
                    <label class="form-check-label" for="<?= $jawab['kode_jawaban'] . $p2['nama_gejala']; ?>">
                      <?= $jawab['jawaban']; ?>
                    </label>
                  </div>
                  <?php
                endforeach;
                $i++;
              endforeach;
              ?>
            </div>
          </div>
          <a href="hasil.php">
            <button type="submit" style="margin-left: 80%" class="btn btn-primary mt-5" name="submit">Submit</button>
          </a>
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