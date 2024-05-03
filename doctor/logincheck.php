<?php

session_start();

    // Doktor zaten oturum açmamışsa giriş sayfasına yönlendir
    if(!isset($_SESSION['d_email'])) {
        header("Location: login.php");
        die();
    }
?>