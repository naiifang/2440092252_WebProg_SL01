<?php

session_start();

if (isset($_POST["login"])) {
    $usernameLogin = $_POST["usernameLogin"];
    $passwordLogin = $_POST["passwordLogin"];

    if (!isset($_SESSION["username"]) || !isset($_SESSION["password"])) {
        $_SESSION["verified"] = false;
        header("Location: login.php");
    } else if (
        $usernameLogin == $_SESSION["username"]
        && $passwordLogin == $_SESSION["password"]
    ) {
        $_SESSION["verified"] = true;
        header("Location: home.php");
        exit;
    } else {
        $_SESSION["verified"] = false;
        header("Location: login.php");
    }
}
