<?php

session_start();
if (!isset($_SESSION['verified']) || !$_SESSION['verified']) {
    header('Location: welcome.php');
    exit;
}

require "functions.php";

$userID = $_SESSION["apk_user"];
$user = query("SELECT * FROM users WHERE user_id = $userID")[0];

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Aplikasi Pengelolaan Keuangan</title>
    <link rel="stylesheet" href="./style/style.css">
    <link rel="stylesheet" href="./style/register.css">
    <link rel="stylesheet" href="./style/editProfile.css">
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
        <h1>Edit Profile</h1>
        <form action="./prosesEditProfile.php" method="POST" enctype="multipart/form-data">
            <input type="hidden" name="userId" value="<?= $user['user_id'] ?>">
            <div class="form-elements-container grid">
                <div class="form-element">
                    <label for="namaDepan"> Nama Depan </label>
                    <input type="text" name="namaDepan" id="namaDepan" value="<?= $user["nama_depan"]; ?>" required>
                </div>
                <div class="form-element">
                    <label for="namaTengah"> Nama Tengah </label>
                    <input type="text" name="namaTengah" id="namaTengah" value="<?= $user["nama_tengah"]; ?>" required>
                </div>
                <div class="form-element">
                    <label for="namaBelakang"> Nama Belakang </label>
                    <input type="text" name="namaBelakang" id="namaBelakang" value="<?= $user["nama_belakang"]; ?>" required>
                </div>
                <div class="form-element">
                    <label for="tempatLahir"> Tempat Lahir </label>
                    <input type="text" name="tempatLahir" id="tempatLahir" value="<?= $user["tempat_lahir"]; ?>" required>
                </div>
                <div class="form-element">
                    <label for="tanggalLahir"> Tgl Lahir </label>
                    <input type="date" name="tanggalLahir" id="tanggalLahir" value="<?= $user["tanggal_lahir"]; ?>" required>
                </div>
                <div class="form-element">
                    <label for="NIK"> NIK </label>
                    <input type="number" name="NIK" id="NIK" min="0" value="<?= $user['NIK']; ?>" required>
                </div>
                <div class="form-element">
                    <label for="kewarganegaraan"> Warga Negara </label>
                    <input type="text" name="kewarganegaraan" id="kewarganegaraan" value="<?= $user['kewarganegaraan']; ?>" required>
                </div>
                <div class="form-element">
                    <label for="email"> Email </label>
                    <input type="email" name="email" id="email" value="<?= $user['email']; ?>" required>
                </div>
                <div class="form-element">
                    <label for="HP"> No HP </label>
                    <input type="tel" name="HP" id="HP" value="<?= $user['nomor_telepon']; ?>" required>
                </div>
                <div class="form-element">
                    <label for="alamat"> Alamat </label>
                    <textarea name="alamat" id="alamat" rows="5" required><?= $user["alamat"]; ?></textarea>
                </div>
                <div class="form-element">
                    <label for="kodepos"> Kode Pos </label>
                    <input type="number" name="kodepos" id="kodepos" min="0" value="<?= $user['kode_pos']; ?>" required>
                </div>
                <div class="form-element">
                    <div class="flex-column">
                        <label for="foto"> Foto Profil </label>
                        <p id="foto-req">(.jpg, .jpeg, .png)</p>
                    </div>
                    <div class="flex-column">
                        <img src=<?= "./uploaded/" . $user['foto_profil'] ?> alt="">
                        <input type="hidden" name="fotoLama" id="fotoLama" value="<?= $user['foto_profil']; ?>">
                        <input type="file" name="foto" id="foto">
                    </div>
                </div>
            </div>
            <div class="buttons-container">
                <input type="button" value="Kembali" onclick="location.href='profile.php'">
                <button type="submit" name="edit">Simpan</button>
            </div>
        </form>
    </main>
</body>

</html>