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
    <div class="content" style="width:80%;">
    <div class="container" style="padding-left: 35px; padding-right: 20px;">
      <h1 style="text-align:center; margin-top: 30px; color: black; padding: 0px 35px">Deteksi Diagnosis Penyakit Saluran Pernapasan</h1>
      <form>
        <div class="mb-3">
            <label for="exampleInputEmail1" class="form-label">Nama</label>
            <input type="email" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp">
        </div>
        <div class="mb-3">
            <label for="exampleInputEmail1" class="form-label">Usia</label>
            <input type="email" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp">
        </div>
        <h5 >Silahkan Menjawab Pertanyaan ini untuk Mendapatkan Hasil Deteksi dan Solusi</h5>
        <div class="row">
            <div class="col-6">
                <h6>1. Apakah....?</h6>
                <div class="form-check">
                <input class="form-check-input" type="checkbox" value="" id="flexCheckDefault">
                <label class="form-check-label" for="flexCheckDefault">
                    Sangat Sering
                </label>
                </div>
                <div class="form-check">
                <input class="form-check-input" type="checkbox" value="" id="flexCheckChecked" checked>
                <label class="form-check-label" for="flexCheckChecked">
                    Sering
                </label>
                </div>
                <div class="form-check">
                <input class="form-check-input" type="checkbox" value="" id="flexCheckDefault">
                <label class="form-check-label" for="flexCheckDefault">
                    Jarang
                </label>
                </div>
                <div class="form-check">
                <input class="form-check-input" type="checkbox" value="" id="flexCheckDefault">
                <label class="form-check-label" for="flexCheckDefault">
                    Tidak Pernah
                </label>
                </div>
            </div>
            <div class="col-6">
                <h6>2. Apakah ......?</h6>
                <div class="form-check">
                <input class="form-check-input" type="checkbox" value="" id="flexCheckDefault">
                <label class="form-check-label" for="flexCheckDefault">
                    Sangat Sering
                </label>
                </div>
                <div class="form-check">
                <input class="form-check-input" type="checkbox" value="" id="flexCheckChecked" checked>
                <label class="form-check-label" for="flexCheckChecked">
                    Sering
                </label>
                </div>
                <div class="form-check">
                <input class="form-check-input" type="checkbox" value="" id="flexCheckDefault">
                <label class="form-check-label" for="flexCheckDefault">
                    Jarang
                </label>
                </div>
                <div class="form-check">
                <input class="form-check-input" type="checkbox" value="" id="flexCheckDefault">
                <label class="form-check-label" for="flexCheckDefault">
                    Tidak Pernah
                </label>
                </div>
            </div>
        </div>
        <a href="hasil.php">
        <button type="submit" style="margin-left: 80%" class="btn btn-primary mt-5">Submit</button>
        </a>
      </form>
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