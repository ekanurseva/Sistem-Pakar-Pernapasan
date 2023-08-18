<?php
require_once 'konek.php';
validasi_admin();
if (isset($_GET['idsolusi'])) {
    $id_solusi = $_GET['idsolusi'];

    if (hapus_solusi($id_solusi) > 0) {
        echo "
                <script>
                    alert('Data Berhasil Dihapus');
                    document.location.href='penyakit.php';
                </script>
            ";
    } else {
        echo "
                <script>
                    alert('Data Gagal Dihapus');
                    document.location.href='penyakit.php';
                </script>
            ";
    }
}
?>