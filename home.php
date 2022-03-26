<?php

session_start();

// kalau belum logged in, gabisa akses page ini
if (!isset($_SESSION['verified']) || !$_SESSION['verified']) {
    header('Location: welcome.php');
    exit;
}

$namaLengkap = "User";
if (isset($_SESSION["namaDepan"])) $namaLengkap = $_SESSION["namaDepan"];
if (isset($_SESSION["namaTengah"])) $namaLengkap .= " " . $_SESSION["namaTengah"];
if (isset($_SESSION["namaBelakang"])) $namaLengkap .= " " . $_SESSION["namaBelakang"];

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Aplikasi Pengelolaan Keuangan</title>
    <link rel="stylesheet" href="./style/style.css">
    <link rel="stylesheet" href="./style/home.css">
</head>

<body>
    <header class="flex-row">
        <p class="app-name">Aplikasi Pengelolaan Keuangan</p>
        <nav>
            <a href="./home.php" class="current">Home</a>
            <a href="./profile.php">Profile</a>
            <a href="./logout.php">Log Out</a>
        </nav>
    </header>

    <main>
        <p class="hello">
            <?= "Halo "; ?>
            <span>
                <?= $namaLengkap; ?>
            </span>
            <?= ", selamat datang di <br>Aplikasi Pengelolaan Keuangan"; ?>
        </p>
    </main>
</body>

</html>