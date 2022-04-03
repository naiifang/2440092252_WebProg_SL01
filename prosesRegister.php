<?php

session_start();

$error_pw = false;
$error_ph = false;

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
            $error_ph = true;
        }
    } else {
        $error_pw = true;
    }
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Aplikasi Pengelola Keuangan</title>
</head>

<body>
    <form action="./register.php" method="POST" id="registerFormError">
        <input type="hidden" name="error_pw" value="<?= $error_pw; ?>">
        <input type="hidden" name="error_ph" value="<?= $error_ph; ?>">
    </form>

    <script>
        function formAutoSubmit() {
            var form = document.getElementById("registerFormError");
            form.submit();
        }

        window.onload = formAutoSubmit;
    </script>
</body>

</html>