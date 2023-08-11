<?php
include("konek.php");
$data_user = query("SELECT * FROM user WHERE level ='user'");
if (isset($_POST["submit_user"])) {
    if (register($_POST) > 0) {
        echo "
        <script>
        alert('Registrasi Berhasil');
        document.location.href='login.php';
        </script>
        ";
    } else {
        echo "<script>
        alert('Registrasi Gagal');
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
    <div class="content">
        <div class="container">
            <h1 style="margin-top:50px; margin-button:50px; text-align: center;">Sistem Pakar Diagnosa Penyakit Saluran
                Pernapasan</h1>
            <div class="content">
                <div class="tabel">
                    <div class="container" style="padding-left: 35px; padding-right: 20px;">
                        <h1 style="text-align:center; margin-top: 30px; color: black; padding: 0px 35px">Registrasi</h1>
                        <form action="" method="post">
                            <div class="mb-3">
                                <label for="exampleInputEmail1" class="form-label">Nama</label>
                                <input name="nama" type="text" class="form-control">
                            </div>
                            <div class="mb-3">
                                <label for="exampleInputEmail1" class="form-label">Username</label>
                                <input name="username" type="text" class="form-control">
                            </div>
                            <div class="mb-3">
                                <label for="exampleInputEmail1" class="form-label">Email</label>
                                <input name="email" type="email" class="form-control">
                            </div>
                            <div class="mb-3">
                                <label for="exampleInputEmail1" class="form-label">Password</label>
                                <input name="password" type="password" class="form-control">
                            </div>
                            <div class="mb-3">
                                <label for="exampleInputEmail1" class="form-label">Konfirmasi Password</label>
                                <input name="password2" type="password" class="form-control">
                            </div>
                            <div class="mb-3">
                                <label class="form-label">Jenis Kelamin</label>
                                <select class="form-select" name="jk" aria-label="Default select example">
                                    <option selected>Pilih Jenis Kelamin</option>
                                    <option value="P">Perempuan</option>
                                    <option value="L">Laki-Laki</option>
                                </select>
                            </div>
                            <button type="submit" class="btn btn-primary mb-3" name="submit_user">
                                <a class="text-decoration-none"></a>
                                Submit</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-geWF76RCwLtnZ8qwWowPQNguL3RmwHVBC9FhGdlKrxdiJJigb/j/68SIy3Te4Bkz"
        crossorigin="anonymous"></script>
    <script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.7.1/jquery.min.js"></script>

</body>

</html>