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
    <link rel="stylesheet" href="./style/login.css">
</head>

<body>
    <header class="flex-row">
        <p class="app-name">Aplikasi Pengelolaan Keuangan</p>
    </header>

    <main>
        <h1>Login</h1>
        <form action="./prosesLogin.php" method="post" class="flex-col">
            <div class="form-elements-container flex-col">
                <div class="form-element">
                    <label for="usernameLogin"> Username </label>
                    <input type="text" name="usernameLogin" id="usernameLogin">
                </div>
                <div class="form-element">
                    <label for="passwordLogin"> Password </label>
                    <input type="password" name="passwordLogin" id="passwordLogin">
                </div>
            </div>
            <div class="buttons-container">
                <button type="submit" name="login">Login</button>
                <input type="button" value="Kembali" onclick="location.href='welcome.php'">
            </div>
        </form>
        <?php if (isset($_SESSION["verified"]) && !$_SESSION["verified"]) : ?>
            <p id="error-msg">Wrong account information!</p>
        <?php endif; ?>
    </main>
</body>

</html>