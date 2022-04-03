<?php

session_start();
$_SESSION["verified"] = null;
$_SESSION["apk_user"] = null;
session_destroy();

header("Location: welcome.php");
