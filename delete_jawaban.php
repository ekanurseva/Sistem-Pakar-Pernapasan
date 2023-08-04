<?php
require_once 'konek.php';
if (isset($_GET['idjawaban'])) {
    $id_jawaban = $_GET['idjawaban'];

    if (hapus_jawaban($id_jawaban) > 0) {
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