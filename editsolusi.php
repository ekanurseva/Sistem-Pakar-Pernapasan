<?php
include("konek.php");
validasi_admin();

$id = dekripsi($_COOKIE['pernapasan']);
$data_diri = query("SELECT * FROM user WHERE iduser = $id")[0];

$penyakit = mysqli_query($koneksi, "SELECT * FROM diagnosa ORDER BY iddiagnosa DESC");

$idsolusi = $_GET['id'];
$data = query("SELECT * FROM solusi WHERE idsolusi = $idsolusi")[0];

if (isset($_POST["submit_solusi"])) {
    if (edit_solusi($_POST) > 0) {
        echo "
    <script>
    alert('Data Solusi Berhasil Diubah');
    document.location.href='penyakit.php';
    </script>
    ";
    } else {
        echo "<script>
    alert('Data Solusi Gagal Diubah');
    document.location.href='penyakit.php';
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
                <img src="img/<?= $data_diri['foto']; ?>" style="width:50px; margin-right: auto; margin-left: auto; display:block"
                    alt="">
                <h5 class="offcanvas-title fw-bold text-center" style="font-size: 20px" id="offcanvasLabel"><?= $data_diri['nama']; ?></h5>
            </div>
            <ul class="">
                <li class=""><a style="font-size: 17px; text-decoration: none;" href="index.php">Dashboard</a></li>

                <li class=""><a href="riwayatdeteksi.php" style="font-size: 17px; text-decoration: none;">Riwayat
                        Deteksi</a>
                </li>
                <li class=""><a href="pertanyaan.php" style="font-size: 17px; text-decoration: none;">Pertanyaan dan
                        Jawaban</a>
                </li>
                <li class=""><a href="gejala.php" style="font-size: 17px; text-decoration: none;">Data Gejala</a></li>
                <li class="active"><a href="penyakit.php" style="font-size: 17px; text-decoration: none;">Penyakit dan
                        Solusi
                    </a></li>
                <li class=""><a href="datapengguna.php" style="font-size: 17px; text-decoration: none;">Data
                        Pengguna</a></li>
                <li class=""><a href="datadiri.php" style="font-size: 17px; text-decoration: none;">Data Diri</a></li>
                <li class=""><a href="keluar.php" style="font-size: 17px; text-decoration: none;">Keluar</a></li>
            </ul>
        </div>
        <div class="content" style="width:80%;">
            <div class="container" style="padding-left: 35px; padding-right: 20px;">
                <h1 style="text-align:center; margin-top: 30px; color: black; padding: 0px 35px">Insert Data Penyakit
                    dan Solusi</h1>
                <form action="" method="post">
                    <input type="hidden" name="idsolusi" value="<?= $data['idsolusi']; ?>">

                    <div class="mb-3 mt-3">
                        <label class="form-label">Penyakit</label>
                        <select class="boxc form-control" name="iddiagnosa" require>
                            <option value="" hidden selected>--Pilih Penyakit--</option>
                            <?php
                            foreach ($penyakit as $p):
                                ?>
                                <option value="<?php echo $p['iddiagnosa'] ?>" <?php echo ($p['iddiagnosa'] == $data['iddiagnosa']) ? 'selected' : ''; ?>><?php echo $p['nama_diagnosa'] ?></option>
                                <?php
                            endforeach
                            ?>
                        </select>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Solusi</label>
                        <textarea name="solusi" id="" cols="30" rows="10"
                            class="form-control"><?php echo $data['solusi']; ?></textarea>
                    </div>

                    <button type="submit" name="submit_solusi" class="btn btn-primary">Submit</button>
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