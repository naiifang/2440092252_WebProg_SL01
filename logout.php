<?php

session_start();
$_SESSION["verified"] = null;

header("Location: welcome.php");
