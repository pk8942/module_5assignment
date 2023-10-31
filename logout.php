<?php
session_start();
session_unset();
if(isset($_POST["logout"])){
    session_destroy();
}
if(!isset($_POST["role"])){
    header("Location: login.php");
}

?>