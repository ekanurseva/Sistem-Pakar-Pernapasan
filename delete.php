<?php 
    require_once 'konek.php';
    if(isset($_GET['iduser'])) {
        $id_user = $_GET['iduser'];

        if(hapus_user($id_user) > 0) {
            echo "
                <script>
                    alert('Data Berhasil Dihapus');
                    document.location.href='datapengguna.php';
                </script>
            ";
        } else {
            echo "
                <script>
                    alert('Data Gagal Dihapus');
                    document.location.href='datapengguna.php';
                </script>
            ";
        }
    }
?>