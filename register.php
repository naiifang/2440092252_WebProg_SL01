<?php

session_start();
$error = false;

// kalau sudah logged in, gabisa akses page ini
if (isset($_SESSION["verified"]) && $_SESSION["verified"]) {
    header("Location: home.php");
    exit;
}

if (isset($_POST["register"])) {
    // cek password
    if ($_POST["password"] == $_POST["confirmPassword"]) {

        $_SESSION["namaDepan"] = $_POST["namaDepan"];
        $_SESSION["namaTengah"] = $_POST["namaTengah"];
        $_SESSION["namaBelakang"] = $_POST["namaBelakang"];
        $_SESSION["tempatLahir"] = $_POST["tempatLahir"];
        $_SESSION["tanggalLahir"] = $_POST["tanggalLahir"];
        $_SESSION["NIK"] = $_POST["NIK"];
        $_SESSION["kewarganegaraan"] = $_POST["kewarganegaraan"];
        $_SESSION["email"] = $_POST["email"];
        $_SESSION["HP"] = $_POST["HP"];
        $_SESSION["alamat"] = $_POST["alamat"];
        $_SESSION["kodepos"] = $_POST["kodepos"];
        $_SESSION["username"] = $_POST["username"];
        $_SESSION["password"] = $_POST["password"];

        // cek uploaded file
        $fileName = $_FILES["foto"]["name"];
        $fileName = str_replace(' ', '', $fileName); // handle nama file yang ada spasi, tpi blm bisa handle file dgn nama yg sama
        $tmpName = $_FILES["foto"]["tmp_name"];

        $allowedExt = ["png", "jpg", "jpeg"];
        $ext = pathinfo($fileName, PATHINFO_EXTENSION);
        if (in_array($ext, $allowedExt)) {
            $_SESSION["foto"] = $fileName;

            // pindahkan file dari temporary ke terupload
            $dirUpload = "uploaded/";
            $terupload = move_uploaded_file($tmpName, $dirUpload . $fileName);

            // balik ke halaman welcome
            header("Location: welcome.php");
            exit;
        } else {
            $error = true;
        }
    } else {
        $error = true;
    }
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
    <link rel="stylesheet" href="./style/register.css">
</head>

<body>
    <header class="flex-row">
        <p class="app-name">Aplikasi Pengelolaan Keuangan</p>
    </header>

    <main>
        <h1>Register</h1>
        <form action="" method="POST" enctype="multipart/form-data">
            <div class="form-elements-container grid">
                <div class="form-element">
                    <label for="namaDepan"> Nama Depan </label>
                    <input type="text" name="namaDepan" id="namaDepan" required>
                </div>
                <div class="form-element">
                    <label for="namaTengah"> Nama Tengah </label>
                    <input type="text" name="namaTengah" id="namaTengah" required>
                </div>
                <div class="form-element">
                    <label for="namaBelakang"> Nama Belakang </label>
                    <input type="text" name="namaBelakang" id="namaBelakang" required>
                </div>
                <div class="form-element">
                    <label for="tempatLahir"> Tempat Lahir </label>
                    <input type="text" name="tempatLahir" id="tempatLahir" required>
                </div>
                <div class="form-element">
                    <label for="tanggalLahir"> Tgl Lahir </label>
                    <input type="date" name="tanggalLahir" id="tanggalLahir" required>
                </div>
                <div class="form-element">
                    <label for="NIK"> NIK </label>
                    <input type="number" name="NIK" id="NIK" min="0" required>
                </div>
                <div class="form-element">
                    <label for="kewarganegaraan"> Warga Negara </label>
                    <input type="text" name="kewarganegaraan" id="kewarganegaraan" required>
                </div>
                <div class="form-element">
                    <label for="email"> Email </label>
                    <input type="email" name="email" id="email" required>
                </div>
                <div class="form-element">
                    <label for="HP"> No HP </label>
                    <input type="tel" name="HP" id="HP" required>
                </div>
                <div class="form-element">
                    <label for="alamat"> Alamat </label>
                    <textarea name="alamat" id="alamat" rows="5" required></textarea>
                </div>
                <div class="form-element">
                    <label for="kodepos"> Kode Pos </label>
                    <input type="number" name="kodepos" id="kodepos" min="0" required>
                </div>
                <div class="form-element">
                    <div class="flex-column">
                        <label for="foto"> Foto Profil </label>
                        <p id="foto-req">(.jpg, .jpeg, .png)</p>
                    </div>
                    <input type="file" name="foto" id="foto" required>
                </div>
                <div class="form-element">
                    <label for="username"> Username </label>
                    <input type="text" name="username" id="username" required>
                </div>
                <div class="form-element">
                    <label for="password"> Password </label>
                    <input type="password" name="password" id="password" required>
                </div>
                <div class="form-element">
                    <label for="confirmPassword"> Confirm password </label>
                    <input type="password" name="confirmPassword" id="confirmPassword" required>
                </div>
            </div>
            <div class="buttons-container">
                <input type="button" value="Kembali" onclick="location.href='welcome.php'">
                <button type="submit" name="register">Register</button>
            </div>
        </form>
        <?php if ($error) : ?>
            <p id="error-msg">Make sure both passwords are the same!<br>Make sure you uploaded file with the correct extension!</p>
        <?php endif; ?>
    </main>
</body>

</html>