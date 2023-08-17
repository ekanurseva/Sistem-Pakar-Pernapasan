<?php 
  require_once 'konek.php';

  $email = dekripsi($_GET['key']);

  $data = query("SELECT * FROM user WHERE email = '$email'")[0];

  if(isset($_POST['submit'])) {
        $iduser = $_POST['iduser'];
        $password = mysqli_real_escape_string($koneksi, $_POST["password"]);
        $password2 = mysqli_real_escape_string($koneksi, $_POST["password2"]);

        if ($password !== $password2) {
            $error = true;
        } else {
          $password = password_hash($password2, PASSWORD_DEFAULT);
  
          $query = "UPDATE user SET 
                      password = '$password'
                    WHERE iduser = '$iduser'
                  ";
          mysqli_query($koneksi, $query);

          echo "
            <script>
                alert('Password berhasil diubah, silahkan login');
                document.location.href='login.php';
            </script>
          ";
        }
  }
?>

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
    <div class="content text-center">
      <div class="container">
      <h1 style="margin-top:50px; margin-button:50px;">Selamat Datang Di Sistem Pakar Diagnosa Penyakit Saluran Pernapasan</h1>
      <div class="row">
        <div class="col-5 me-5">
        <img class= "text-start" src="img/dokter.png" style="width:370px;" alt="">
        </div>
        <div class="col-7 login mt-5">
          <form action="" method="post">
            <h4 class= "mt-4" >Ubah Password</h4>
            <input type="hidden" name="iduser" value="<?= $data['iduser']; ?>">
            <?php if (isset ($error)) : ?>
              <div class="alert alert-danger" role="alert">
                Password tidak sesuai
              </div>
            <?php endif;?>
            <input type="text" class="form-control mb-4" id="" value="<?= $data['nama']; ?>" disabled>
            <input placeholder="Password" type="password" class="form-control mb-4" name="password">
            <input placeholder="Konfirmasi Password" type="password" class="form-control mb-4" name="password2">

            <button style= "margin-left: -388px; width:100px;" type="submit" class="btn btn-primary mb-4 me-4" name="submit">Submit</button>
          </form>
           
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