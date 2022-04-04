<?php

$server = "localhost";
$username = "root";
$password = "";
$db_name = "aplikasi_pengelola_keuangan";
$port_number = "3307";

// buat koneksi
$connection = mysqli_connect($server, $username, $password, $db_name, $port_number);

if ($connection) {
    echo "<script>console.log('Koneksi berhasil')</script>";
} else {
    throw new Exception("Mysql Connection Error: " . mysqli_connect_error());
}

// lakukan query dan return sebuah array assosiatif
function query($query)
{
    global $connection;
    $result = mysqli_query($connection, $query);
    $rows = [];
    while ($row = mysqli_fetch_assoc($result)) {
        $rows[] = $row;
    }
    return $rows;
}


// cek dan upload gambar
function upload($var_name)
{
    $namaFile = $_FILES[$var_name]['name'];
    $namaFile = str_replace(' ', '', $namaFile);
    $tmpName = $_FILES[$var_name]['tmp_name'];

    $ekstensiGambarValid = ['jpg', 'jpeg', 'png'];
    $ekstensiGambar = pathinfo($namaFile, PATHINFO_EXTENSION);
    $ekstensiGambar = strtolower($ekstensiGambar);
    if (!in_array($ekstensiGambar, $ekstensiGambarValid)) {
        echo "
            <script>
                alert('File tidak didukung!');
            </script>
        ";
        return false;
    } else {
        // upload
        $dirUpload = "uploaded/";
        $terupload = move_uploaded_file($tmpName, $dirUpload . $namaFile);

        if (!$terupload) {
            echo "
            <script>
                alert('File gagal diupload');
            </script>
            ";
        }

        return $terupload;
    }
}


function ubah($data)
{
    global $connection;
    print_r($data);

    $userId = $data["userId"];
    $namaDepan = $data["namaDepan"];
    $namaTengah = $data["namaTengah"];
    $namaBelakang = $data["namaBelakang"];
    $tempatLahir = $data["tempatLahir"];
    $tanggalLahir = $data["tanggalLahir"];
    $NIK = $data["NIK"];
    $kewarganegaraan = $data["kewarganegaraan"];
    $email = $data["email"];
    $HP = $data["HP"];
    $alamat = $data["alamat"];
    $kodepos = $data["kodepos"];
    $namaFile = $_FILES["foto"]["name"];

    // cek apakah user pilih gambar baru atau tidak
    if ($_FILES["foto"]["error"] === 4) {
        $namaFile = $data["fotoLama"];
    } else {
        if (!upload('foto')) {
            $namaFile = $data["fotoLama"];
            return false;
            exit;
        }
    }

    $query = "UPDATE users SET
                nama_depan = '$namaDepan',
                nama_tengah = '$namaTengah',
                nama_belakang = '$namaBelakang',
                tempat_lahir = '$tempatLahir',
                tanggal_lahir = '$tanggalLahir',
                NIK = '$NIK',
                kewarganegaraan = '$kewarganegaraan',
                email = '$email',
                nomor_telepon = '$HP',
                alamat = '$alamat',
                kode_pos = '$kodepos',
                foto_profil = '$namaFile'
                WHERE user_id = $userId
            ";
    mysqli_query($connection, $query);

    return mysqli_affected_rows($connection);
}


function registrasi($data)
{
    global $connection;

    $username = strtolower(stripslashes($data["username"]));
    $password = mysqli_real_escape_string($connection, $data["password"]);
    $confirmPassword = mysqli_real_escape_string($connection, $data["confirmPassword"]);

    $namaDepan = $data["namaDepan"];
    $namaTengah = $data["namaTengah"];
    $namaBelakang = $data["namaBelakang"];
    $tempatLahir = $data["tempatLahir"];
    $tanggalLahir = $data["tanggalLahir"];
    $NIK = $data["NIK"];
    $kewarganegaraan = $data["kewarganegaraan"];
    $email = $data["email"];
    $HP = $data["HP"];
    $alamat = $data["alamat"];
    $kodepos = $data["kodepos"];
    $namaFile = $_FILES["foto"]["name"];

    // cek ketersediaan username
    $result = mysqli_query($connection, "SELECT username FROM users WHERE username = '$username'");
    if (mysqli_fetch_assoc($result)) {
        echo "<script>
                alert('Username sudah terdaftar! Silahkan pilih username lain');
            </script>";
        return false;
    }

    // cek konfirmasi password
    if ($password !== $confirmPassword) {
        echo "<script>
                alert('Password tidak sama!');
            </script>";
        return false;
    }

    // cek file + upload
    if (!upload('foto')) {
        return false;
    }

    // enkripsi password
    $password = password_hash($password, PASSWORD_DEFAULT);

    // tambahkan user bar ke database
    mysqli_query($connection, "INSERT INTO users VALUES ('', '$username', '$password', '$namaDepan', '$namaTengah', '$namaBelakang', '$tempatLahir', '$tanggalLahir', '$NIK', '$kewarganegaraan', '$email', '$HP', '$alamat', '$kodepos', '$namaFile')");

    return mysqli_affected_rows($connection);
}
