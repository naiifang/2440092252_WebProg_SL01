<?php

session_start();
if (!isset($_SESSION['verified']) || !$_SESSION['verified']) {
    header('Location: welcome.php');
    exit;
}

require "functions.php";

if (isset($_POST["edit"])) {

    if (ubah($_POST) > 0) {
        echo "
            <script>
                alert('Data berhasil diubah!');
            </script>
        ";
        header("Location: profile.php");
        exit;
    } else {
        echo mysqli_error($connection);
        echo "
            <script>
                alert('Pengubahan data gagal dilakukan!');
            </script>
        ";
        header("Location: editProfile.php");
        exit;
    }
}
