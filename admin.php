<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-9ndCyUaIbzAi2FUVXJi0CjmCapSmO7SnpJef0486qhLnuZ2cdeRhO02iuK6FUUVM" crossorigin="anonymous">
<link rel="stylesheet" href="style.css">
</head>
<body>
  <div class="main-container d-flex">
    <div class="sidebar px-3 pt-3">
      <div class="header pb-3">
      <img src="img/admin.png" style = "width:50px; margin-right: auto; margin-left: auto; display:block" alt=""> <h5 class="offcanvas-title fw-bold text-center" style = "font-size: 20px" id="offcanvasLabel">ADMIN</h5>
      </div>
      <ul class="">
        <li class="active"><a style="font-size: 17px; text-decoration: none;" href= "admin.php" >Dashboard</a></li>
        <li class=""><a href = "riwayatdeteksi.php" style="font-size: 17px; text-decoration: none;">Riwayat Deteksi</a></li>
        <li class=""><a href = "pertanyaan.php" style="font-size: 17px; text-decoration: none;">Pertanyaan dan Jawaban</a></li>
        <li class=""><a href = "gejala.php" style="font-size: 17px; text-decoration: none;">Data Gejala</a></li>
        <li class=""><a href = "penyakit.php" style="font-size: 17px; text-decoration: none;">Penyakit dan Solusi </a></li>
        <li class=""><a href = "datapengguna.php" style="font-size: 17px; text-decoration: none;">Data Pengguna</a></li>
        <li class=""><a href = "datadiri.php" style="font-size: 17px; text-decoration: none;">Data Diri</a></li>
        <li class=""><a href = "keluar.php" style="font-size: 17px; text-decoration: none;">Keluar</a></li>
      </ul>
    </div>
    <div class="content text-center">
      <div class="container">
      <h1 style="margin-top:50px; margin-button:50px;">Selamat Datang Di Sistem Pakar Diagnosa Penyakit Saluran Pernapasan</h1>
      <img src="img/dokter.png" style="width:370px;" alt="">
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