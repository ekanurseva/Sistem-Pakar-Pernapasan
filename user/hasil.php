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
            <h6 class= "pt-3">Nur Aeni (22 tahun)</h6>
            <h6 class= "pb-3">Diagnosa Penyakit Saluran Pernapasannya adalah:</h6>
            <div class="row" style= "padding: 0 100px;">
                <div class="col-6 pb-3">
                    <div class="tabel py-3" style= "background:rgb(253, 246, 247);">
                        <h5>Certainty Factor:</h5>
                        <h3>Influenza 90%</h3>
                        <h3>Tuberkulosis 85%</h3>
                        <h3>Asma 70%</h3>
                    </div>
                </div>
                <div class="col-6 pb-3">
                    <div class="tabel py-3" style= "background:rgb(253, 246, 247);">
                        <h5>Teorema Bayes:</h5>
                        <h3>Influenza 75%</h3>
                        <h3>Tuberkulosis 65%</h3>
                        <h3>Asma 55%</h3>
                    </div>
                </div>
                <h6 class= "text-start pb-3" >Deskripsi:</h6>
                <h6 class= "text-start  pb-3">Solusi:</h6>
            </div>
        </div>
        <div class="text-end pt-3">
        <a style= "margin: 0 75px;" class="text-decoration-none" href="registrasi.php">
            <button style= "width:100px; background:rgb(248, 129, 149);" type="submit" class="btn mb-4">Cetak</button>
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