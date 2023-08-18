<?php 
    require_once 'konek.php';
    validasi_admin();
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
    } elseif(isset($_GET['idhasil'])) {
        $id_hasil = $_GET['idhasil'];

        if(hapus_hasil($id_hasil) > 0) {
            echo "
                <script>
                    alert('Data Berhasil Dihapus');
                    document.location.href='riwayatdeteksi.php';
                </script>
            ";
        } else {
            echo "
                <script>
                    alert('Data Gagal Dihapus');
                    document.location.href='riwayatdeteksi.php';
                </script>
            ";
        }
    }
?>