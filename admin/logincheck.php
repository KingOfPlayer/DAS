<?php

session_start();

    // Doktor zaten oturum açmamışsa giriş sayfasına yönlendir
    if(!isset($_SESSION['a_email'])) {
        header("Location: login.php");
        die();
    }
?>