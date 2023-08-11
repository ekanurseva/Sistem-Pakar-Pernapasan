<?php 
    require_once 'konek.php';
    if(isset($_COOKIE['pernapasan'])) {
        $id = dekripsi($_COOKIE['pernapasan']);

        
        $result = mysqli_query($koneksi, "SELECT * FROM user WHERE iduser = '$id'");
        
        if (mysqli_num_rows($result) !== 1) {
            echo "<script>
                    document.location.href='keluar.php';
                </script>";
            exit;
        } else {
            $cek = query("SELECT * FROM user WHERE iduser = '$id'") [0];
            if($cek['level'] == "admin") {
                echo "<script>
                        document.location.href='admin.php';
                    </script>";
                exit;
            } elseif($cek['level'] == "user") {
                echo "<script>
                        document.location.href='user';
                    </script>";
                exit;
            }
        } 
    } else {
        echo "<script>
                    document.location.href='keluar.php';
                </script>";
        exit;
    }
?>