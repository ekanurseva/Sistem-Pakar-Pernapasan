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
function register($data)
{
    global $koneksi;
    $username = strtolower(stripslashes($data["username"]));
    $password = mysqli_real_escape_string($koneksi, $data["password"]);
    $password2 = mysqli_real_escape_string($koneksi, $data["password2"]);
    $nama = $data['nama'];
    $jk = $data['jk'];
    $email = $data['email'];
    $telepon = $data['telepon'];
    $level = "user";
    $tgl_lahir = $data['tgl_lahir'];

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

    mysqli_query($koneksi, "INSERT INTO user VALUES ('NULL', '$username', '$password', '$nama', '$jk', '$email', '$telepon', '$level', '$tgl_lahir')");

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
    $telepon = $data['telepon'];
    $level = "admin";
    $tgl_lahir = $data['tgl_lahir'];

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

    mysqli_query($koneksi, "INSERT INTO user VALUES ('NULL', '$username', '$password', '$nama', '$jk', '$email', '$telepon', '$level', '$tgl_lahir')");

    return mysqli_affected_rows($koneksi);
}

function edit_pengguna($data)
{
    global $koneksi;

    $iduser = $data['iduser'];
    $oldusername = $data['oldusername'];
    $oldpassword = $data['oldpassword'];
    $oldemail = $data['oldemail'];
    $username = strtolower(stripslashes($data["username"]));
    $password = mysqli_real_escape_string($koneksi, $data["password"]);
    $password2 = mysqli_real_escape_string($koneksi, $data["password2"]);
    $nama = $data['nama'];
    $jk = $data['jk'];
    $email = htmlspecialchars($data['email']);
    $telepon = $data['telepon'];
    $tgl_lahir = $data['tgl_lahir'];

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

    $query = "UPDATE user SET 
                username = '$username',
                password = '$password',
                nama = '$nama',
                jk = '$jk',
                email = '$email',
                telepon = '$telepon',
                level = '$level',
                tgl_lahir = '$tgl_lahir'
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

    function get_kode_gejala($diagnosis){
        global $koneksi;
        $data_diagnosis = query("SELECT kode_diagnosa FROM diagnosa WHERE iddiagnosa = $diagnosis") [0];
        $kode_diagnosa = $data_diagnosis['kode_diagnosa'];

        $query = "SELECT * FROM gejala WHERE iddiagnosa = $diagnosis";
        $kode = "";

        $jumlah = jumlah_data($query);

        if($jumlah == 0) {
            $kode = $kode_diagnosa . "1";
        } else {
            for($i = 1; $i <= $jumlah; $i++) { 
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
            };
        }

        return $kode;
    }
?>