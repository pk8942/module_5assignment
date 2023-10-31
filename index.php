<?php
session_start();

if (!isset($_SESSION["email"])) {
    header("Location: login.php");
}

if ($_SESSION["role"] == "user") {
    header("Location: home_user.php");
}
if ($_SESSION["role"] == "admin") {
    header("Location: homeform2.php");
}
if (isset($_POST['edit'])) {

    $editEmail = $_POST['edit'];
    $encode = base64_encode($editEmail);
    header("Location: edit.php?email=$encode");
    exit();
}

?>
