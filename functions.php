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
function upload()
{
    $namaFile = $_FILES['foto']['name'];
    $namaFile = str_replace(' ', '', $namaFile);
    $tmpName = $_FILES['foto']['tmp_name'];

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


function registrasi($data)
{
    global $connection;

    $username = strtolower(stripslashes($data["username"]));
    $password = mysqli_real_escape_string($connection, $data["password"]);
    $confirmPassword = mysqli_real_escape_string($connection, $data["confirmPassword"]);

    $namaDepan = $_POST["namaDepan"];
    $namaTengah = $_POST["namaTengah"];
    $namaBelakang = $_POST["namaBelakang"];
    $tempatLahir = $_POST["tempatLahir"];
    $tanggalLahir = $_POST["tanggalLahir"];
    $NIK = $_POST["NIK"];
    $kewarganegaraan = $_POST["kewarganegaraan"];
    $email = $_POST["email"];
    $HP = $_POST["HP"];
    $alamat = $_POST["alamat"];
    $kodepos = $_POST["kodepos"];
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
    if (!upload()) {
        return false;
    }

    // enkripsi password
    $password = password_hash($password, PASSWORD_DEFAULT);

    // tambahkan user bar ke database
    mysqli_query($connection, "INSERT INTO users VALUES ('', '$username', '$password', '$namaDepan', '$namaTengah', '$namaBelakang', '$tempatLahir', '$tanggalLahir', '$NIK', '$kewarganegaraan', '$email', '$HP', '$alamat', '$kodepos', '$namaFile')");

    return mysqli_affected_rows($connection);
}
