<?php

session_start();

// kalau sudah logged in, gabisa akses page ini
if (isset($_SESSION["verified"]) && $_SESSION["verified"]) {
    header("Location: home.php");
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
    <link rel="stylesheet" href="./style/welcome.css">
</head>

<body>
    <header class="flex-row">
        <p class="app-name">Aplikasi Pengelolaan Keuangan</p>
        <p>Welcome</p>
    </header>

    <main class="flex-col">
        <p id="welcome-message">Selamat Datang di Aplikasi Pengelolaan Keuangan</p>
        <div class="menu-container flex-row">
            <a href="login.php" class="menu-item">Log in</a>
            <a href="register.php" class="menu-item">Register</a>
        </div>
    </main>
</body>

</html>