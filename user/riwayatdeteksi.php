<?php 
  require_once '../konek.php';
  validasi();

  $iduser = dekripsi($_COOKIE['pernapasan']);
  $user = query("SELECT * FROM user WHERE iduser = '$iduser'")[0];

  $data_hasil = query("SELECT * FROM hasil_diagnosa WHERE iduser = $iduser");
?>


<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-9ndCyUaIbzAi2FUVXJi0CjmCapSmO7SnpJef0486qhLnuZ2cdeRhO02iuK6FUUVM" crossorigin="anonymous">
<link rel="stylesheet" href="../style.css">
</head>
<body>
  <div class="main-container d-flex">
    <div class="sidebar px-3 pt-3">
      <div class="header pb-3">
      <img src="../img/<?= $user['foto']; ?>" style = "width:50px; margin-right: auto; margin-left: auto; display:block" alt=""> <h5 class="offcanvas-title fw-bold text-center" style = "font-size: 20px" id="offcanvasLabel"><?= $user['nama']; ?></h5>
      </div>
      <ul class="">
        <li class=""><a style="font-size: 17px; text-decoration: none;"href = "index.php" >Dashboard</a></li>
        <li class=""><a href = "deteksi.php" style="font-size: 17px; text-decoration: none;">Mulai Deteksi</a></li>
        <li class="active"><a href = "riwayatdeteksi.php" style="font-size: 17px; text-decoration: none;">Riwayat Deteksi</a></li>
        <li class=""><a href = "datadiri.php" style="font-size: 17px; text-decoration: none;">Data Diri</a></li>
        <li class=""><a href = "../keluar.php" style="font-size: 17px; text-decoration: none;">Keluar</a></li>
      </ul>
    </div>
    <div class="content" style="width:80%;">
      <div class="container">
        <div class="head">
            <h1 style="text-align: center; margin-top:45px; margin-button:45px;">Riwayat Deteksi</h1>
            <!-- <img src="img/dokter.png" style="width:200px; possition:absolute;" alt=""> -->
        </div>
        <div class="col-7">
            <form style= "margin-top: 40px;" class="d-flex" role="search">
                <input class="form-control me-2" type="search" placeholder="Search" aria-label="Search">
                <button class="btn btn-outline-success" type="submit">Search</button>
            </form>
            </div> 
        <div class="row align-items-start text-center">
     
        <table class="table mt-3">
            <thead>
                <tr>
                  <th scope="col">No</th>
                  <th scope="col">Waktu</th>
                  <th scope="col">Aksi</th>
                </tr>
            </thead>
            <tbody>
              <?php 
                $i = 1;
                foreach($data_hasil as $hasil) :
              ?>
                <tr>
                  <th scope="row"><?= $i; ?></th>
                  <?php $waktu_tes = strftime('%H:%M:%S / %d %B %Y', strtotime($hasil['tanggal'])); ?>
                  <td><?= $waktu_tes; ?></td>
                  <td><a style= "text-decoration: none;" href="hasil.php?idhasil=<?= $hasil['idhasil']; ?>">Detail</a> | <a style= "text-decoration: none;" href="../print.php?idhasil=<?= $hasil['idhasil']; ?>" target="_blank">Cetak</a></td>
                </tr>
              <?php 
                $i++;
                endforeach;
              ?>
            </tbody>
        </table>
      </div>
    </div>
  </div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-geWF76RCwLtnZ8qwWowPQNguL3RmwHVBC9FhGdlKrxdiJJigb/j/68SIy3Te4Bkz" crossorigin="anonymous"></script>
<script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.7.1/jquery.min.js"></script>
<script>
  $(".sidebar ul li").on ('click', function(){
    $(".sidebar ul li.active").removeClass("active")
    $(this).addClass("active");
  })
</script>
</body>
</html>