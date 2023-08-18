<?php
require_once 'konek.php';
validasi_admin();
if (isset($_GET['idpertanyaan'])) {
    $id_pertanyaan = $_GET['idpertanyaan'];

    if (hapus_pertanyaan($id_pertanyaan) > 0) {
        echo "
                <script>
                    alert('Data Berhasil Dihapus');
                    document.location.href='pertanyaan.php';
                </script> 
            ";
    } else {
        echo "
                <script>
                    alert('Data Gagal Dihapus');
                    document.location.href='pertanyaan.php';
                </script>
            ";
    }
}
?>