<?php
$koneksi = mysqli_connect("localhost", "root", "", "pernapasan");
if (mysqli_connect_errno()) {
    echo "Gagal Koneksi Gaes" . mysqli_connect_error();
}

function query($query)
{
    global $koneksi;
    $result = mysqli_query($koneksi, $query);
    $rows = [];
    while ($row = mysqli_fetch_assoc($result)) {
        $rows[] = $row;
    }
    return $rows;
}
function jumlah_data($data)
{
    global $koneksi;
    $query = mysqli_query($koneksi, $data);

    $jumlah_data = mysqli_num_rows($query);

    return $jumlah_data;
}

function dekripsi($teks)
{
    $text = $teks;
    $kunci = 'pernapasan';
    $key = hash('sha256', $kunci);
    $pkey = "123";

    $method = "aes-192-cfb1";
    $iv = substr(hash('sha256', $pkey), 0, 16);

    $dekripsi = base64_decode($text);
    $dekripsi = openssl_decrypt($dekripsi, $method, $key, 0, $iv);

    return $dekripsi;
}
function enkripsi($teks)
{
    $text = $teks;
    $kunci = 'pernapasan';
    $key = hash('sha256', $kunci);
    $pkey = "123";

    $method = "aes-192-cfb1";
    $iv = substr(hash('sha256', $pkey), 0, 16);

    $enkripsi = openssl_encrypt($text, $method, $key, 0, $iv);
    $enkripsi = base64_encode($enkripsi);

    return $enkripsi;
}

function validasi() {
    global $koneksi;
    if (!isset($_COOKIE['pernapasan'])) {
        echo "<script>
                document.location.href='logout.php';
              </script>";
        exit;
    }
    
    $id = dekripsi($_COOKIE['pernapasan']);
    
    $result = mysqli_query($koneksi, "SELECT * FROM user WHERE iduser = '$id'");
    
    if (mysqli_num_rows($result) !== 1) {
        echo "<script>
                document.location.href='logout.php';
              </script>";
        exit;
    }
}

function validasi_admin() {
    global $koneksi;
    if (!isset($_COOKIE['pernapasan'])) {
        echo "<script>
                document.location.href='../logout.php';
              </script>";
        exit;
    }
    
    $id = dekripsi($_COOKIE['pernapasan']);

    $cek = query("SELECT * FROM user WHERE iduser = $id") [0];
    
    $result = mysqli_query($koneksi, "SELECT * FROM user WHERE iduser = '$id'");

    if (mysqli_num_rows($result) !== 1) {
        echo "<script>
                document.location.href='../logout.php';
              </script>";
        exit;
    } elseif($cek['role'] !== "Admin") {
        echo "<script>
                document.location.href='../logout.php';
              </script>";
        exit;
    }
}

// Fungsi Upload Foto
function uploadFoto()
{
    $namaFile = $_FILES['foto']['name'];
    $ukuranFile = $_FILES['foto']['size'];
    $tmpName = $_FILES['foto']['tmp_name'];

    // Cek apakah ada gambar yang diupload atau tidak
    if ($namaFile != "") {
        //cek apakah yang di upload gambar atau bukan
        $validFoto = ['jpg', 'jpeg', 'png'];
        $kesesuaianFoto = explode('.', $namaFile);
        $kesesuaianFoto = strtolower(end($kesesuaianFoto));

        //cek apakah ekstensinya ada atau tidak di dalam array $validFoto
        if (!in_array($kesesuaianFoto, $validFoto)) {
            echo "<script>
                    alert('Periksa Kembali File yang Anda Upload');
                    </script>";
            return false;
        }
    }


    //cek jika ukurannya terlalu besar, ukurannya dalam byte
    if ($ukuranFile > 5000000) {
        echo "<script>
                alert('Ukuran gambar terlalu besar, jangan melebihi 5mb');
                </script>";
        return false;
    }

    //generate nama gambar baru
    if ($namaFile != "") {
        $namaFileBaru = uniqid();
        $namaFileBaru .= '.';
        $namaFileBaru .= $kesesuaianFoto;
        //parameternya file namenya, lalu tujuannya
        move_uploaded_file($tmpName, '../img/' . $namaFileBaru);
        move_uploaded_file($tmpName, 'img/' . $namaFileBaru);

        return $namaFileBaru;
    } else {
        $namaFileBaru = "";

        return $namaFileBaru;
    }
}
// Fungsi Upload Foto Selesai

function register($data)
{
    global $koneksi;
    $username = strtolower(stripslashes($data["username"]));
    $password = mysqli_real_escape_string($koneksi, $data["password"]);
    $password2 = mysqli_real_escape_string($koneksi, $data["password2"]);
    $nama = $data['nama'];
    $jk = $data['jk'];
    $email = $data['email'];
    $level = "user";
    $foto = uploadFoto();
    if ($foto == "") {
        $foto = "admin.png";
    }

    $result = mysqli_query($koneksi, "SELECT username FROM user WHERE username = 'username'") or die(mysqli_error($koneksi));
    if (mysqli_fetch_assoc($result)) {
        echo "<script>
            alert('Username Sudah Dipakai!');
        </script>";
        return false;
    }
    if ($password !== $password2) {
        echo "<script>
            alert('Password Tidak Sesuai!');
        </script>";
        return false;
    }
    $password = password_hash($password2, PASSWORD_DEFAULT);

    mysqli_query($koneksi, "INSERT INTO user VALUES ('NULL', '$username', '$password', '$nama', '$jk', '$email', '$level', '$foto')");

    return mysqli_affected_rows($koneksi);
}

function register_admin($data)
{
    global $koneksi;
    $username = strtolower(stripslashes($data["username"]));
    $password = mysqli_real_escape_string($koneksi, $data["password"]);
    $password2 = mysqli_real_escape_string($koneksi, $data["password2"]);
    $nama = $data['nama'];
    $jk = $data['jk'];
    $email = $data['email'];
    $level = "admin";
    $foto = uploadFoto();
    if ($foto == "") {
        $foto = "admin.png";
    }

    $result = mysqli_query($koneksi, "SELECT username FROM user WHERE username = 'username'") or die(mysqli_error($koneksi));
    if (mysqli_fetch_assoc($result)) {
        echo "<script>
            alert('Username Sudah Dipakai!');
        </script>";
        return false;
    }
    if ($password !== $password2) {
        echo "<script>
            alert('Password Tidak Sesuai!');
        </script>";
        return false;
    }
    $password = password_hash($password2, PASSWORD_DEFAULT);

    mysqli_query($koneksi, "INSERT INTO user VALUES ('NULL', '$username', '$password', '$nama', '$jk', '$email', '$level', '$foto')");

    return mysqli_affected_rows($koneksi);
}

function edit_pengguna($data)
{
    global $koneksi;

    $iduser = $data['iduser'];
    $oldusername = $data['oldusername'];
    $oldpassword = $data['oldpassword'];
    $oldfoto = $data['oldfoto'];
    $oldemail = $data['oldemail'];
    $username = strtolower(stripslashes($data["username"]));
    $password = mysqli_real_escape_string($koneksi, $data["password"]);
    $password2 = mysqli_real_escape_string($koneksi, $data["password2"]);
    $nama = $data['nama'];
    $jk = $data['jk'];
    $email = htmlspecialchars($data['email']);
    $foto = uploadFoto();
    if ($foto == "") {
        $foto = $oldfoto;
    }

    if (isset($data['oldlevel'])) {
        $level = $data['oldlevel'];
    } else {
        $level = $data['level'];
    }


    if ($username !== $oldusername) {
        $result = mysqli_query($koneksi, "SELECT username FROM user WHERE username = '$username'");

        if (mysqli_fetch_assoc($result)) {
            echo "<script>
                alert('Username Sudah Dipakai!');
            </script>";
            return false;
        }
    }

    if ($password !== $oldpassword) {
        if ($password !== $password2) {
            echo "<script>
                    alert('Password Tidak Sesuai!');
                  </script>";
            return false;
        }

        $password = password_hash($password2, PASSWORD_DEFAULT);
    }

    if ($email !== $oldemail) {
        $result = mysqli_query($koneksi, "SELECT email FROM user WHERE email = '$email'");

        if (mysqli_fetch_assoc($result)) {
            echo "<script>
                    alert('Email sudah digunakan, silahkan pakai email lain');
                  </script>";
            return false;
        }
    }


    if ($foto != $oldfoto && $oldfoto != "admin.png") {
        unlink("img/$oldfoto");
        unlink("../img/$oldfoto");
    }

    $query = "UPDATE user SET 
                username = '$username',
                password = '$password',
                nama = '$nama',
                jk = '$jk',
                email = '$email',
                level = '$level',
                foto = '$foto'
              WHERE iduser = '$iduser'
            ";
    mysqli_query($koneksi, $query);

    return mysqli_affected_rows($koneksi);
}

function profil($data)
{
    global $koneksi;

    $iduser = $data['iduser'];
    $oldusername = $data['oldusername'];
    $oldpassword = $data['oldpassword'];
    $oldfoto = $data['oldfoto'];
    $oldemail = $data['oldemail'];
    $username = strtolower(stripslashes($data["username"]));
    $password = mysqli_real_escape_string($koneksi, $data["password"]);
    $password2 = mysqli_real_escape_string($koneksi, $data["password2"]);
    $nama = $data['nama'];
    $jk = $data['jk'];
    $email = htmlspecialchars($data['email']);
    $foto = uploadFoto();
    if ($foto == "") {
        $foto = $oldfoto;
    }

    if (isset($data['oldlevel'])) {
        $level = $data['oldlevel'];
    } else {
        $level = $data['level'];
    }


    if ($username !== $oldusername) {
        $result = mysqli_query($koneksi, "SELECT username FROM user WHERE username = '$username'");

        if (mysqli_fetch_assoc($result)) {
            echo "<script>
                alert('Username Sudah Dipakai!');
            </script>";
            return false;
        }
    }

    if ($password !== $oldpassword) {
        if ($password !== $password2) {
            echo "<script>
                    alert('Password Tidak Sesuai!');
                  </script>";
            return false;
        }

        $password = password_hash($password2, PASSWORD_DEFAULT);
    }

    if ($email !== $oldemail) {
        $result = mysqli_query($koneksi, "SELECT email FROM user WHERE email = '$email'");

        if (mysqli_fetch_assoc($result)) {
            echo "<script>
                    alert('Email sudah digunakan, silahkan pakai email lain');
                  </script>";
            return false;
        }
    }


    if ($foto != $oldfoto && $oldfoto != "admin.png") {
        unlink("img/$oldfoto");
        unlink("../img/$oldfoto");
    }

    $query = "UPDATE user SET 
                username = '$username',
                password = '$password',
                nama = '$nama',
                jk = '$jk',
                email = '$email',
                level = '$level',
                foto = '$foto'
              WHERE iduser = '$iduser'
            ";
    mysqli_query($koneksi, $query);

    return mysqli_affected_rows($koneksi);
}

function hapus_user($iduser)
{
    global $koneksi;
    mysqli_query($koneksi, "DELETE FROM user WHERE iduser = $iduser");

    return mysqli_affected_rows($koneksi);
}

function create_penyakit($data)
{
    global $koneksi;
    $nama_penyakit = $data['nama_penyakit'];
    $kode_penyakit = $data['kode'];
    $deskripsi = $data['deskripsi'];
    $solusi = $data['solusi'];

    $result = mysqli_query($koneksi, "SELECT nama_diagnosa FROM diagnosa WHERE nama_diagnosa = 'nama_penyakit'") or die(mysqli_error($koneksi));
    if (mysqli_fetch_assoc($result)) {
        echo "<script>
            alert('Nama Penyakit Sudah Dipakai!');
        </script>";
        return false;
    }

    $result = mysqli_query($koneksi, "SELECT kode_diagnosa FROM diagnosa WHERE kode_diagnosa = 'kode'") or die(mysqli_error($koneksi));
    if (mysqli_fetch_assoc($result)) {
        echo "<script>
            alert('Kode Penyakit Sudah Dipakai!');
        </script>";
        return false;
    }

    mysqli_query($koneksi, "INSERT INTO diagnosa VALUES (NULL, '$kode_penyakit', '$nama_penyakit', '$deskripsi', '$solusi')");

    return mysqli_affected_rows($koneksi);
}

function edit_penyakit($data)
{
    global $koneksi;
    $iddiagnosa = $data['iddiagnosa'];
    $oldpenyakit = $data['oldpenyakit'];
    $oldkode = $data['oldkode'];
    $nama_penyakit = $data['nama_penyakit'];
    $kode_penyakit = $data['kode'];
    $deskripsi = $data['deskripsi'];
    $solusi = $data['solusi'];

    if ($nama_penyakit !== $oldpenyakit) {
        $result = mysqli_query($koneksi, "SELECT nama_diagnosa FROM diagnosa WHERE nama_diagnosa = '$nama_penyakit'");

        if (mysqli_fetch_assoc($result)) {
            echo "<script>
                alert('Nama Penyakit Sudah Dipakai!');
            </script>";
            return false;
        }
    }

    if ($kode_penyakit !== $oldkode) {
        $result = mysqli_query($koneksi, "SELECT kode_diagnosa FROM diagnosa WHERE kode_diagnosa = '$kode_penyakit'");

        if (mysqli_fetch_assoc($result)) {
            echo "<script>
                    alert('Kode sudah digunakan, silahkan pakai kode lain');
                  </script>";
            return false;
        }
    }

    $query = "UPDATE diagnosa SET 
                 kode_diagnosa = '$kode_penyakit',
                 nama_diagnosa = '$nama_penyakit',
                 deskripsi = '$deskripsi',
                 solusi = '$solusi'
              WHERE iddiagnosa = '$iddiagnosa'
            ";
    mysqli_query($koneksi, $query);

    return mysqli_affected_rows($koneksi);
}

function hapus_diagnosa($iddiagnosa)
{
    global $koneksi;
    mysqli_query($koneksi, "DELETE FROM diagnosa WHERE iddiagnosa = $iddiagnosa");

    return mysqli_affected_rows($koneksi);
}

function create_solusi($data)
{
    global $koneksi;
    $iddiagnosa = $data['iddiagnosa'];
    $solusi = $data['solusi'];

    $result = mysqli_query($koneksi, "SELECT solusi FROM solusi WHERE solusi = 'solusi'") or die(mysqli_error($koneksi));
    if (mysqli_fetch_assoc($result)) {
        echo "<script>
            alert('Nama Penyakit Sudah Dipakai!');
        </script>";
        return false;
    }

    mysqli_query($koneksi, "INSERT INTO solusi VALUES (NULL, '$iddiagnosa', '$solusi')");

    return mysqli_affected_rows($koneksi);
}

function edit_solusi($data)
{
    global $koneksi;

    $idsolusi = $data['idsolusi'];
    $iddiagnosa = $data['iddiagnosa'];
    $solusi = $data['solusi'];

    $query = "UPDATE solusi SET 
                iddiagnosa = '$iddiagnosa',
                solusi = '$solusi'
              WHERE idsolusi = '$idsolusi'
              ";
    mysqli_query($koneksi, $query);

    return mysqli_affected_rows($koneksi);
}

function hapus_solusi($idsolusi)
{
    global $koneksi;
    mysqli_query($koneksi, "DELETE FROM solusi WHERE idsolusi = $idsolusi");

    return mysqli_affected_rows($koneksi);
}

function create_gejala($data)
{
    global $koneksi;
    $iddiagnosa = $data['diagnosa'];
    $kode_gejala = $data['kode_gejala'];
    $nama_gejala = $data['gejala'];
    $bobot = $data['bobot'];

    $result = mysqli_query($koneksi, "SELECT nama_gejala FROM gejala WHERE nama_gejala = 'gejala'") or die(mysqli_error($koneksi));
    if (mysqli_fetch_assoc($result)) {
        echo "<script>
            alert('Nama Gejala Sudah Dipakai!');
        </script>";
        return false;
    }

    $result = mysqli_query($koneksi, "SELECT kode_gejala FROM gejala WHERE kode_gejala = 'kode_gejala'") or die(mysqli_error($koneksi));
    if (mysqli_fetch_assoc($result)) {
        echo "<script>
            alert('Kode Gejala Sudah Dipakai!');
        </script>";
        return false;
    }

    mysqli_query($koneksi, "INSERT INTO gejala VALUES (NULL, '$iddiagnosa', '$kode_gejala', '$nama_gejala', '$bobot')");

    return mysqli_affected_rows($koneksi);
}

function edit_gejala($data)
{
    global $koneksi;
    $idgejala = $data['idgejala'];
    $nama_gejala = $data['gejala'];
    $bobot = $data['bobot'];

    $query = "UPDATE gejala SET 
                 nama_gejala = '$nama_gejala',
                 bobot = '$bobot'
              WHERE idgejala = '$idgejala'
            ";
    mysqli_query($koneksi, $query);

    return mysqli_affected_rows($koneksi);
}

function hapus_gejala($idgejala)
{
    global $koneksi;
    mysqli_query($koneksi, "DELETE FROM gejala WHERE idgejala = $idgejala");

    return mysqli_affected_rows($koneksi);
}


function create_pertanyaan($data)
{
    global $koneksi;
    $nama_pertanyaan = $data['pertanyaan'];
    $kode_pertanyaan = $data['kode_pertanyaan'];
    $idgejala = $data['gejala'];

    $result = mysqli_query($koneksi, "SELECT pertanyaan FROM pertanyaan WHERE pertanyaan = 'pertanyaan'") or die(mysqli_error($koneksi));
    if (mysqli_fetch_assoc($result)) {
        echo "<script>
            alert('Pertanyaan Sudah Dipakai!');
        </script>";
        return false;
    }

    $result = mysqli_query($koneksi, "SELECT kode_pertanyaan FROM pertanyaan WHERE kode_pertanyaan = 'kode'") or die(mysqli_error($koneksi));
    if (mysqli_fetch_assoc($result)) {
        echo "<script>
            alert('Kode Pertanyaan Sudah Dipakai!');
        </script>";
        return false;
    }

    mysqli_query($koneksi, "INSERT INTO pertanyaan VALUES (NULL, '$idgejala', '$kode_pertanyaan', '$nama_pertanyaan')");

    return mysqli_affected_rows($koneksi);
}

function edit_pertanyaan($data)
{
    global $koneksi;
    $idpertanyaan = $data['idpertanyaan'];
    $oldidgejala = $data['oldidgejala'];
    $oldkode_pertanyaan = $data['kode_pertanyaan'];
    $oldnama_pertanyaan = $data['pertanyaan'];
    $idgejala = $data['gejala'];
    $kode_pertanyaan = $data['kode_pertanyaan'];
    $nama_pertanyaan = $data['pertanyaan'];

    if (isset($data['idgejala'])) {
        $idgejala = $data['idgejala'];
    } else {
        $idgejala = $oldidgejala;
    }

    if ($oldkode_pertanyaan !== $kode_pertanyaan) {
        $result = mysqli_query($koneksi, "SELECT kode_pertanyaan FROM pertanyaan WHERE kode_pertanyaan = '$kode_pertanyaan'");

        if (mysqli_fetch_assoc($result)) {
            echo "<script>
                alert('Kode sudah digunakan, silahkan pakai kode lain');
            </script>";
            return false;
        }
    }
    if ($oldnama_pertanyaan !== $nama_pertanyaan) {
        $result = mysqli_query($koneksi, "SELECT pertanyaan FROM pertanyaan WHERE pertanyaan = '$nama_pertanyaan'");

        if (mysqli_fetch_assoc($result)) {
            echo "<script>
                alert('Pertanyaan sudah ada, silahkan gunakan pertanyaan lain');
            </script>";
            return false;
        }
    }

    $query = "UPDATE pertanyaan SET 
                 idgejala = '$idgejala',
                 kode_pertanyaan = '$kode_pertanyaan',
                 pertanyaan = '$nama_pertanyaan'
              WHERE idpertanyaan = '$idpertanyaan'
            ";
    mysqli_query($koneksi, $query);

    return mysqli_affected_rows($koneksi);
}

function hapus_pertanyaan($idgejala)
{
    global $koneksi;
    mysqli_query($koneksi, "DELETE FROM pertanyaan WHERE idpertanyaan = $idgejala");

    return mysqli_affected_rows($koneksi);
}


function create_jawaban($data)
{
    global $koneksi;
    $jawaban = $data['jawaban'];
    $kode_jawaban = $data['kode_jawaban'];
    $bobot = $data['bobot'];

    $result = mysqli_query($koneksi, "SELECT kode_jawaban FROM jawaban WHERE kode_jawaban = 'kode'") or die(mysqli_error($koneksi));
    if (mysqli_fetch_assoc($result)) {
        echo "<script>
            alert('Kode Jawaban Sudah Dipakai!');
        </script>";
        return false;
    }

    mysqli_query($koneksi, "INSERT INTO jawaban VALUES (NULL, '$bobot', '$kode_jawaban', '$jawaban')");

    return mysqli_affected_rows($koneksi);
}

function edit_jawaban($data)
{
    var_dump($data);
    global $koneksi;
    $idjawaban = $data['idjawaban'];
    $oldkode_jawaban = $data['oldkode_jawaban'];
    $oldbobot = $data['oldbobot'];
    $oldjawaban = $data['oldjawaban'];
    $kode_jawaban = $data['kode_jawaban'];
    $jawaban = $data['jawaban'];
    $bobot = $data['bobot'];

    if ($oldkode_jawaban !== $kode_jawaban) {
        $result = mysqli_query($koneksi, "SELECT kode_jawaban FROM jawaban WHERE kode_jawaban = '$kode_jawaban'");

        if (mysqli_fetch_assoc($result)) {
            echo "<script>
                alert('Kode sudah digunakan, silahkan pakai kode lain');
            </script>";
            return false;
        }
    }
    if ($oldjawaban !== $jawaban) {
        $result = mysqli_query($koneksi, "SELECT jawaban FROM jawaban WHERE jawaban = '$jawaban'");

        if (mysqli_fetch_assoc($result)) {
            echo "<script>
                alert('Jawaban sudah ada, silahkan gunakan jawaban lain');
            </script>";
            return false;
        }
    }
    if ($oldbobot !== $bobot) {
        $result = mysqli_query($koneksi, "SELECT bobot FROM jawaban WHERE bobot = '$bobot'");

        if (mysqli_fetch_assoc($result)) {
            echo "<script>
                alert('Bobot sudah dipakai, silahkan gunakan bobot lain');
            </script>";
            return false;
        }
    }

    $query = "UPDATE jawaban SET 
                 bobot = '$bobot',
                 kode_jawaban = '$kode_jawaban',
                 jawaban = '$jawaban'
              WHERE idjawaban = '$idjawaban'
            ";
    mysqli_query($koneksi, $query);

    return mysqli_affected_rows($koneksi);
}

function hapus_jawaban($idgejala)
{
    global $koneksi;
    mysqli_query($koneksi, "DELETE FROM jawaban WHERE idjawaban = $idgejala");

    return mysqli_affected_rows($koneksi);
}

function get_kode_gejala($diagnosis)
{
    global $koneksi;
    $data_diagnosis = query("SELECT kode_diagnosa FROM diagnosa WHERE iddiagnosa = $diagnosis")[0];
    $kode_diagnosa = $data_diagnosis['kode_diagnosa'];

    $query = "SELECT * FROM gejala WHERE iddiagnosa = $diagnosis";
    $kode = "";

    $jumlah = jumlah_data($query);

    if ($jumlah == 0) {
        $kode = $kode_diagnosa . "1";
    } else {
        for ($i = 1; $i <= $jumlah; $i++) {
            $query1 = "SELECT COUNT(*) as total FROM gejala WHERE kode_gejala = '$kode_diagnosa{$i}'";
            $result = mysqli_query($koneksi, $query1);
            $row = mysqli_fetch_assoc($result);
            $totalP = $row['total'];

            if ($totalP == 0) {
                $kode = $kode_diagnosa . $i;
                break;
            } else {
                $angka = $jumlah + 1;
                $kode = $kode_diagnosa . $angka;
            }
        }
        ;
    }
}

    function hitung($data)
    {
        global $koneksi;

        $data_penyakit = query("SELECT * FROM diagnosa");
        $gejala = query("SELECT DISTINCT nama_gejala FROM gejala");

        // Ambil CF User
        foreach ($gejala as $gej) {
            $parameter = str_replace(" ", "_", $gej['nama_gejala']);
            $nama_gejala[] = $parameter;

            $jawaban = $data[$parameter];

            $nilai = query("SELECT bobot FROM jawaban WHERE kode_jawaban = '$jawaban'")[0];

            $nilai_cf_user[] = $nilai['bobot'];

            echo "Nilai CF untuk " . $parameter . " adalah " . $nilai['bobot'] . "<br>";
        }
        echo "<br>";
        // Ambil CF User Selesai

        foreach ($data_penyakit as $dp) {
            $idpenyakit = $dp['iddiagnosa'];
            $data_gejala = query("SELECT * FROM gejala WHERE iddiagnosa = $idpenyakit");
            foreach ($data_gejala as $dage) {
                $kata = str_replace(" ", "_", $dage['nama_gejala']);
                $indeks = array_search($kata, $nama_gejala);

                $hasil = $dage['bobot'] * $nilai_cf_user[$indeks];
                ${"cf_he_" . $dp['kode_diagnosa']}[] = $hasil;

                echo "Hasil CF HE dari " . $dp['nama_diagnosa'] . " " . $dage['nama_gejala'] . " perkalian antara " . $dage['bobot'] . " dan " . $nilai_cf_user[$indeks] . " adalah " . $hasil . "<br>";

            }
            echo "<br>";

            ${"cf_old_" . $dp['kode_diagnosa'] . 0} = ${"cf_he_" . $dp['kode_diagnosa']}[0];
            ;

            for ($j = 1; $j < count(${"cf_he_" . $dp['kode_diagnosa']}); $j++) {
                ${"cf_old_" . $dp['kode_diagnosa'] . $j} = ${"cf_old_" . $dp['kode_diagnosa'] . $j - 1} + ${"cf_he_" . $dp['kode_diagnosa']}[$j] * (1 - ${"cf_old_" . $dp['kode_diagnosa'] . $j - 1});

                ${"cf_old_" . $dp['kode_diagnosa']}[] = number_format(${"cf_old_" . $dp['kode_diagnosa'] . $j} * 100, 2);

                echo "Hasil CF OLD " . $dp['kode_diagnosa'] . $j . " dari perkalian " . ${"cf_old_" . $dp['kode_diagnosa'] . $j - 1} . " + " . ${"cf_he_" . $dp['kode_diagnosa']}[$j] . " * (1 - " . ${"cf_old_" . $dp['kode_diagnosa'] . $j - 1} . ") adalah " . ${"cf_old_" . $dp['kode_diagnosa'] . $j} . "<br>";
            }
            echo "<br>";

            ${"nilai_terbesar_" . $dp['kode_diagnosa']} = ${"cf_old_" . $dp['kode_diagnosa']}[0];

            for ($o = 1; $o < count(${"cf_old_" . $dp['kode_diagnosa']}); $o++) {
                if (${"cf_old_" . $dp['kode_diagnosa']}[$o] > ${"nilai_terbesar_" . $dp['kode_diagnosa']}) {
                    ${"nilai_terbesar_" . $dp['kode_diagnosa']} = ${"cf_old_" . $dp['kode_diagnosa']}[$o];
                }
            }
            echo "Nilai terbesar dari " . $dp['kode_diagnosa'] . " adalah " . ${"nilai_terbesar_" . $dp['kode_diagnosa']} . "%<br><br>";


        }
        foreach ($data_penyakit as $dp) {
            $idpenyakit = $dp['iddiagnosa'];
            $data_gejala = query("SELECT * FROM gejala WHERE iddiagnosa = $idpenyakit");
    
            var_dump($data_gejala);
        }
    }
    // Ambil CF User Selesai

    function update_datadiri($data) {
        global $koneksi;
        $iduser = $data['iduser'];
        $oldusername = $data['oldusername'];
        $oldpassword = $data['oldpassword'];
        $nama = $data['nama'];
        $username = $data['username'];
        $email = $data['email'];
        $password = $data['password'];
        $password2 = $data['password2'];
        $jk = $data['jk'];

        if($username !== $oldusername) {
            $result = mysqli_query($koneksi, "SELECT username FROM user WHERE username = '$username'");

            if (mysqli_fetch_assoc($result)) {
                echo "
                    <script>
                        alert('Username sudah digunakan');
                        document.location.href='datadiri.php';
                    </script>
                ";
                exit();
            }
        }

        if($password !== $oldpassword) {
            if ($password !== $password2) {
                echo "<script>
                        alert('Password tidak sesuai!');
                        document.location.href='datadiri.php';
                      </script>";
                exit();
            }

            $password = password_hash($password2, PASSWORD_DEFAULT);
        }

        $query = "UPDATE user SET 
                    username = '$username',
                    password = '$password',
                    nama = '$nama',
                    jk = '$jk',
                    email = '$email'
                  WHERE iduser = '$iduser'
                ";
        mysqli_query($koneksi, $query);

        return mysqli_affected_rows($koneksi);
    }
?>