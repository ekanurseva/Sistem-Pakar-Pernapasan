<?php
require_once 'konek.php';
validasi_admin();
if (isset($_GET['iddiagnosa'])) {
    $id_diagnosa = $_GET['iddiagnosa'];
    delete_field($id_diagnosa);

    if (hapus_diagnosa($id_diagnosa) > 0) {
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