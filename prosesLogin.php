<?php

session_start();
if (isset($_SESSION["verified"]) && $_SESSION["verified"]) {
    header("Location: home.php");
    exit;
}

require "functions.php";

if (isset($_POST["login"])) {
    $usernameLogin = $_POST["usernameLogin"];
    $passwordLogin = $_POST["passwordLogin"];

    $result = mysqli_query($connection, "SELECT * FROM users WHERE username = '$usernameLogin'");

    if (mysqli_num_rows($result) === 1) {
        // cek password
        $row = mysqli_fetch_assoc($result);
        if (password_verify($passwordLogin, $row["password"])) {

            // set session
            $_SESSION["verified"] = true;
            $_SESSION["apk_user"] = $row["user_id"];

            // pindahkan user ke halaman index
            header("Location: home.php");
            exit;
        }
    }

    $_SESSION["verified"] = false;
    header("Location: login.php");
}
