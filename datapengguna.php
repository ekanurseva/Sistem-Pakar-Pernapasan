<?php
include("konek.php");
validasi_admin();
$data = query("SELECT * FROM user");

$id = dekripsi($_COOKIE['pernapasan']);
$data_diri = query("SELECT * FROM user WHERE iduser = $id")[0];

$jumlah_admin = jumlah_data("SELECT * FROM user WHERE level = 'admin'");
$jumlah_user = jumlah_data("SELECT * FROM user WHERE level = 'user'");
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
  <link rel="stylesheet" href="https://cdn.datatables.net/1.13.4/css/jquery.dataTables.min.css">
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
        <li class=""><a style="font-size: 17px; text-decoration: none;" href="admin.php">Dashboard</a></li>
        <li class=""><a href="riwayatdeteksi.php" style="font-size: 17px; text-decoration: none;">Riwayat Deteksi</a>
        </li>
        <li class=""><a href="pertanyaan.php" style="font-size: 17px; text-decoration: none;">PData Jawaban</a>
        </li>
        <li class=""><a href="gejala.php" style="font-size: 17px; text-decoration: none;">Data Gejala</a></li>
        <li class=""><a href="penyakit.php" style="font-size: 17px; text-decoration: none;">Penyakit dan Solusi </a>
        </li>
        <li class="active"><a href="datapengguna.php" style="font-size: 17px; text-decoration: none;">Data Pengguna</a>
        </li>
        <li class=""><a href="datadiri.php" style="font-size: 17px; text-decoration: none;">Data Diri</a></li>
        <li class=""><a href="keluar.php" style="font-size: 17px; text-decoration: none;">Keluar</a></li>
      </ul>
    </div>
    <div class="content" style="width:80%;">
      <div class="container">
        <div class="head">
          <h1 style="text-align: center; margin-top:45px; margin-button:45px;">Data Pengguna</h1>
          <!-- <img src="img/dokter.png" style="width:200px; possition:absolute;" alt=""> -->
        </div>
        <div class="row mt-4 align-items-start text-center">
          <div class="col-4">
            <div class="card" style="width: 15rem;">
              <div class="card-body">
                <a class="card-title" href="inputpenggunaadmin.php"><button>+</button> Insert Data Admin</a>
                <h6 class="card-subtitle mb-2 text-body-secondary">Jumlah Admin</h6>
                <p class="card-text">
                  <?= $jumlah_admin; ?>
                </p>
              </div>
            </div>
          </div>

          <div class="col-4">
            <div class="card" style="width: 15rem;">
              <div class="card-body">
                <a class="card-title" href="inputpenggunauser.php"><button>+</button> Insert Data User</a>
                <h6 class="card-subtitle mb-2 text-body-secondary">Jumlah User</h6>
                <p class="card-text">
                  <?= $jumlah_user; ?>
                </p>
              </div>
            </div>
          </div>

          <table class="table mt-3" id="example">
            <thead>
              <tr>
                <th scope="col">No</th>
                <th scope="col">Nama</th>
                <th scope="col">Username</th>
                <th scope="col">Email</th>
                <th scope="col">Level</th>
                <th scope="col">Aksi</th>
              </tr>
            </thead>
            <tbody>
              <?php
              $i = 1;
              foreach ($data as $k):
                ?>
                <tr>
                  <th>
                    <?php echo $i; ?>
                  </th>
                  <td>
                    <?= $k['nama']; ?>
                  </td>
                  <td>
                    <?= $k['username']; ?>
                  </td>
                  <td>
                    <?= $k['email']; ?>
                  </td>
                  <td>
                    <?= $k['level']; ?>
                  </td>
                  <td>
                    <a style="text-decoration: none;" href="editpengguna.php?id=<?= $k['iduser']; ?> ">Edit </a> |
                    <a style="text-decoration: none;" href="delete.php?iduser=<?= $k['iduser']; ?>"
                      onclick="return confirm('Apakah anda yakin ingin menghapus data?')">Hapus</a>
                  </td>
                </tr>
                <?php
                $i++;
              endforeach
              ?>
            </tbody>
          </table>
        </div>
      </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"
      integrity="sha384-geWF76RCwLtnZ8qwWowPQNguL3RmwHVBC9FhGdlKrxdiJJigb/j/68SIy3Te4Bkz"
      crossorigin="anonymous"></script>
    <script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.7.1/jquery.min.js"></script>
    <script src="https://cdn.datatables.net/1.13.4/js/jquery.dataTables.min.js"></script>
    <script>
      $(document).ready(function () {
        $("#example").DataTable();
      });

      $(".sidebar ul li").on('click', function () {
        $(".sidebar ul li.active").removeClass("active")
        $(this).addClass("active");
      })
    </script>
</body>

</html>