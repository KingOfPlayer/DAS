<?php
    if (session_status() == PHP_SESSION_NONE) {
		session_start();
	}
    // Doktor zaten oturum açmamışsa giriş sayfasına yönlendir
    if(!isset($_SESSION['p_email'])) {
        header("Location: login.php");
        die();
    }
?>