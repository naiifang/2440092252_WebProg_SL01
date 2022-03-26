<?php

session_start();
$error = false;

// kalau belum logged in, gabisa akses page ini
if (!isset($_SESSION['verified']) || !$_SESSION['verified']) {
    header('Location: welcome.php');
    exit;
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Aplikasi Pengelolaan Keuangan</title>
    <link rel="stylesheet" href="./style/style.css">
    <link rel="stylesheet" href="./style/profile.css">
</head>

<body>
    <header class="flex-row">
        <p class="app-name">Aplikasi Pengelolaan Keuangan</p>
        <nav>
            <a href="./home.php">Home</a>
            <a href="./profile.php" class="current">Profile</a>
            <a href="./logout.php">Log Out</a>
        </nav>
    </header>

    <main>
        <h1>Profile</h1>
        <div class="profile-elements-container grid">
            <div class="profile-element">
                <label for="namaDepan"> Nama Depan </label>
                <input type="text" name="namaDepan" value="<?= $_SESSION['namaDepan']; ?>" readonly>

            </div>
            <div class="profile-element">
                <label for="namaTengah"> Nama Tengah </label>
                <input type="text" name="namaTengah" value="<?= $_SESSION['namaTengah']; ?>" readonly>
            </div>
            <div class="profile-element">
                <label for="namaBelakang"> Nama Belakang </label>
                <input type="text" name="namaBelakang" value="<?= $_SESSION['namaBelakang']; ?>" readonly>
            </div>
            <div class="profile-element">
                <label for="tempatLahir"> Tempat Lahir </label>
                <input type="text" name="tempatLahir" value="<?= $_SESSION['tempatLahir']; ?>" readonly>
            </div>
            <div class="profile-element">
                <label for="tanggalLahir"> Tgl Lahir </label>
                <input type="text" name="tanggalLahir" value="<?= $_SESSION['tanggalLahir']; ?>" readonly>
            </div>
            <div class="profile-element">
                <label for="NIK"> NIK </label>
                <input type="text" name="NIK" value="<?= $_SESSION['NIK']; ?>" readonly>
            </div>
            <div class="profile-element">
                <label for="kewarganegaraan"> Warga Negara </label>
                <input type="text" name="kewarganegaraan" value="<?= $_SESSION['kewarganegaraan']; ?>" readonly>
            </div>
            <div class="profile-element">
                <label for="email"> Email </label>
                <input type="text" name="email" value="<?= $_SESSION['email']; ?>" readonly>
            </div>
            <div class="profile-element">
                <label for="HP"> No HP </label>
                <input type="text" name="HP" value="<?= $_SESSION['HP']; ?>" readonly>
            </div>
            <div class="profile-element">
                <label for="alamat"> Alamat </label>
                <textarea name="alamat" rows="5"><?= $_SESSION["alamat"]; ?></textarea>
            </div>
            <div class="profile-element">
                <label for="kodepos"> Kode Pos </label>
                <input type="text" name="kodepos" value="<?= $_SESSION['kodepos']; ?>" readonly>
            </div>
            <div class="profile-element">
                <label for="foto"> Foto Profil </label>
                <div>
                    <img src=<?= "./uploaded/" . $_SESSION['foto'] ?> alt="">
                </div>
            </div>
        </div>
    </main>
</body>

</html>