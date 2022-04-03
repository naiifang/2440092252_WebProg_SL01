<?php

$server = "localhost";
$username = "root";
$password = "";
$db_name = "AplikasiPengelolaKeuangan";
$port_number = "3307";

// buat koneksi
$connection = mysqli_connect($server, $username, $password, $db_name, $port_number);

if ($connection) {
    echo "<script>console.log('Koneksi berhasil')</script>";
} else {
    throw new Exception("Mysql Connection Error: ". mysqli_connect_error());
}
