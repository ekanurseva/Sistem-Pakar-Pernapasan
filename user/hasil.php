<?php 
  require_once '../konek.php';
  validasi();

  $iduser = dekripsi($_COOKIE['pernapasan']);
  $data_user = query("SELECT * FROM user WHERE iduser = $iduser")[0];

  if(isset($_GET['idhasil'])) {
    $idhasil = $_GET['idhasil'];
    $data_hasil = query("SELECT * FROM hasil_diagnosa WHERE idhasil = $idhasil")[0];

    cek_null($data_hasil);

    $penyakit_cf = penyakit_cf($data_hasil);
    $hasil_cf = hasil_cf($data_hasil);
    
    $penyakit_bayes = penyakit_bayes($data_hasil);
    $hasil_bayes = hasil_bayes($data_hasil);
  } else {

    $data_hasil = query("SELECT * FROM hasil_diagnosa WHERE iduser = $iduser AND idhasil = (SELECT MAX(idhasil) FROM hasil_diagnosa WHERE iduser = $iduser)")[0];
    cek_null($data_hasil);
    
    $penyakit_cf = penyakit_cf($data_hasil);
    $hasil_cf = hasil_cf($data_hasil);

    $penyakit_bayes = penyakit_bayes($data_hasil);
    $hasil_bayes = hasil_bayes($data_hasil);
  }

  $terbesar = cari_deskripsi_solusi($data_hasil, $hasil_cf, $hasil_bayes);
  $terbesar_unique = array_values(array_unique($terbesar));
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
      <img src="../img/admin.png" style = "width:50px; margin-right: auto; margin-left: auto; display:block" alt=""> <h5 class="offcanvas-title fw-bold text-center" style = "font-size: 20px" id="offcanvasLabel">USER</h5>
      </div>
      <ul class="">
        <li class=""><a style="font-size: 17px; text-decoration: none;"href = "index.php" >Dashboard</a></li>
        <li class="active"><a href = "deteksi.php" style="font-size: 17px; text-decoration: none;">Mulai Deteksi</a></li>
        <li class=""><a href = "riwayatdeteksi.php" style="font-size: 17px; text-decoration: none;">Riwayat Deteksi</a></li>
        <li class=""><a href = "datadiri.php" style="font-size: 17px; text-decoration: none;">Data Diri</a></li>
        <li class=""><a href = "../keluar.php" style="font-size: 17px; text-decoration: none;">Keluar</a></li>
      </ul>
    </div>
    <div class="content text-center" style="width: 100%; margin-top:50px; margin-button:50px;">
        <h1>Hasil Diagnosa</h1>
        <div class="text-center">
        <div class="tabel mt-3" style="margin: 0 75px;">
            <h6 class= "pt-3"><?= $data_user['nama']; ?></h6>
            <h6 class= "pb-3">Diagnosa Penyakit Saluran Pernapasannya adalah:</h6>
            <div class="row" style= "padding: 0 100px;">
                <div class="col-6 pb-3">
                    <div class="tabel py-3" style= "background:rgb(253, 246, 247);">
                        <h5>Certainty Factor:</h5>
                        <?php for($i = 0; $i < count($penyakit_cf); $i++) : ?>
                          <h3><?= $penyakit_cf[$i]; ?> <?= $hasil_cf[$i]; ?>%</h3>
                        <?php endfor; ?>
                    </div>
                </div>
                <div class="col-6 pb-3">
                    <div class="tabel py-3" style= "background:rgb(253, 246, 247);">
                        <h5>Teorema Bayes:</h5>
                        <?php for($j = 0; $j < count($penyakit_bayes); $j++) : ?>
                          <h3><?= $penyakit_bayes[$j]; ?> <?= $hasil_bayes[$j]; ?>%</h3>
                        <?php endfor; ?>
                    </div>
                </div>
                <h4 class= "text-start" >Deskripsi:</h4>
                <?php foreach($terbesar_unique as $tu) : ?>
                  <h6 class= "text-start"><?= $tu; ?> : </h6>
                  <?php 
                    $penyakit_detail = query("SELECT * FROM diagnosa WHERE nama_diagnosa = '$tu'")[0]; 
                    $deskripsi_penyakit = $penyakit_detail['deskripsi'];
                  ?>
                  <p class="text-start"><?= $deskripsi_penyakit; ?></p>
                <?php endforeach; ?>
                <h4 class= "text-start">Solusi:</h4>
                <?php foreach($terbesar_unique as $tuni) : ?>
                  <h6 class= "text-start"><?= $tuni; ?> : </h6>
                  <?php 
                    $penyakit_detail = query("SELECT * FROM diagnosa WHERE nama_diagnosa = '$tuni'")[0]; 
                    $id_penyakit = $penyakit_detail['iddiagnosa'];
                    $data_solusi = query("SELECT * FROM solusi WHERE iddiagnosa = $id_penyakit");
                  ?>
                  <ul class= "ms-3">
                    <?php foreach($data_solusi as $solusi) : ?>
                      <li class= "text-start"><?= $solusi['solusi']; ?></li>
                    <?php endforeach; ?>
                  </ul>
                <?php endforeach; ?>
            </div>
        </div>
        <div class="text-end pt-3">
        <a style= "margin: 0 75px;" class="text-decoration-none" href="../print.php?idhasil=<?= $data_hasil['idhasil']; ?>" target="_blank">
            <button style= "width:100px; background:rgb(248, 129, 149);" type="" class="btn mb-4">Cetak</button>
            </a>
        </div>
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