<?php 
    require_once 'vendor/autoload.php'; // Lokasi file autoload composer
    require_once 'konek.php';

    if (!isset($_COOKIE['pernapasan'])) {
        echo "<script>
                document.location.href='keluar.php';
              </script>";
        exit;
    } else {
        $id = dekripsi($_COOKIE['pernapasan']);
        
        $result = mysqli_query($koneksi, "SELECT * FROM user WHERE iduser = '$id'");
        
        if (mysqli_num_rows($result) !== 1) {
            echo "<script>
                    document.location.href='keluar.php';
                  </script>";
            exit;
        }
    }

    $idhasil = $_GET['idhasil'];
    $data_hasil = query("SELECT * FROM hasil_diagnosa WHERE idhasil = $idhasil")[0];
    
    $iduser = $data_hasil['iduser'];
    $data_user = query("SELECT * FROM user WHERE iduser = $iduser")[0];
    cek_null($data_hasil);

    $penyakit_cf = penyakit_cf($data_hasil);
    $hasil_cf = hasil_cf($data_hasil);
    
    $penyakit_bayes = penyakit_bayes($data_hasil);
    $hasil_bayes = hasil_bayes($data_hasil);

    $terbesar = cari_deskripsi_solusi($data_hasil, $hasil_cf, $hasil_bayes);
    $terbesar_unique = array_values(array_unique($terbesar));
    

    use Dompdf\Dompdf;
    
    $dompdf = new Dompdf();
    
    // Masukkan kode HTML dan CSS yang ingin Anda konversi ke PDF
    $html =     '<!DOCTYPE html>
            <html lang="en">
            <head>
                <meta charset="UTF-8">
                <meta name="viewport" content="width=device-width, initial-scale=1.0">
                <title>Hasil Tes</title>
                <style>
                    table {
                        border-collapse: collapse;
                        width: 100%;
                    }

                    th, td {
                        border: 1px solid black;
                        padding: 8px;
                        text-align: center;
                    vertical-align: middle;
                    }

                    th {
                        background-color: #f2f2f2;
                    }

                    p {
                        text-align: justify; 
                        text-indent: 0.5in;
                    }
                    li {
                        text-align: left;
                        padding: 0;
                        padding: 0;
                        margin: 0;
                        left: 0;
                    }
                </style>
            </head>
            <body>
                <h1 style="text-align: center;">LAPORAN HASIL TES</h1>
                <h3 style="text-align: center;">'; $html .= $data_user['nama'] . '</h3>

                <h4>Rincian Hasil CF :</h4>
                <table>
                    <tr>';
                        foreach ($penyakit_cf as $pcf) {
                            $html .= "<th>". $pcf ."</th>";
                        }
                    
                    
                    $html .= '</tr>
                    <tr>';
                        foreach ($hasil_cf as $hcf) {
                            $html .= "<td>". $hcf ."</td>";
                        }
                        
                    $html .= '</tr>
                </table>

                <h4>Rincian Hasil Bayes :</h4>
                <table>
                    <tr>'; 
                    foreach ($penyakit_bayes as $pbayes) {
                       $html .= "<th>". $pbayes ."</th>";
                    }
                        
                    $html .= '</tr>
                    <tr>';

                    foreach ($hasil_bayes as $hbayes) {
                        $html .= "<td>". $hbayes ."</td>";
                    }
                        
                    $html .= '</tr>
                </table>

                <h4>Penjabaran Hasil :</h4>
                <table>
                    <tr>
                        <th>Penyakit</th>
                        <th>Solusi</th>
                    </tr>';

                    foreach ($terbesar_unique as $tu) {
                        $penyakit_detail = query("SELECT * FROM diagnosa WHERE nama_diagnosa = '$tu'")[0]; 
                        $deskripsi_penyakit = $penyakit_detail['deskripsi'];
                        $id_penyakit = $penyakit_detail['iddiagnosa'];
                        $data_solusi = query("SELECT * FROM solusi WHERE iddiagnosa = $id_penyakit");

                        $html .= "<tr>
                            <td>" . $deskripsi_penyakit . "</td>
                            <td>
                                <ul>";
                                foreach ($data_solusi as $dasol) {
                                    $html .= "<li>". $dasol['solusi']. "</li>";
                                }

                                $html .= "</ul>
                            </td>
                        </tr>";
                    }
                    $html .= '
                </table>
            </body>
            </html>';
    
    $dompdf->loadHtml($html);
    
    // Render HTML ke PDF
    $dompdf->render();
    
    // Ambil output PDF
    $output = $dompdf->output();

    // Konversi output PDF menjadi data URI
    $pdfDataUri = 'data:application/pdf;base64,' . base64_encode($output);

    // Tampilkan pratinjau PDF di browser
    echo '<embed src="' . $pdfDataUri . '" type="application/pdf" width="100%" height="100%">';
    
?>