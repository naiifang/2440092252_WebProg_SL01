<?php

session_start();
if (isset($_SESSION["verified"]) && $_SESSION["verified"]) {
    header("Location: home.php");
    exit;
}

require "functions.php";

$registrationError = false;

if (isset($_POST["register"])) {

    if (registrasi($_POST) > 0) {
        echo "
            <script>
                alert('User berhasil ditambahkan!');
            </script>
        ";
        header("Location: welcome.php");
        exit;
    } else {
        echo mysqli_error($connection);
        $registrationError = true;
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
        <input type="hidden" name="registrationError" value="<?= $registrationError; ?>">
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