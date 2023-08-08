<?php
require_once 'konek.php';
if (isset($_GET['idgejala'])) {
    $id_gejala = $_GET['idgejala'];

    if (hapus_gejala($id_gejala) > 0) {
        echo "
                <script>
                    alert('Data Berhasil Dihapus');
                    document.location.href='gejala.php';
                </script>
            ";
    } else {
        echo "
                <script>
                    alert('Data Gagal Dihapus');
                    document.location.href='gejala.php';
                </script>
            ";
    }
}
?>