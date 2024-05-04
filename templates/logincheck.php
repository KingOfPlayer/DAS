<?php
    if (session_status() == PHP_SESSION_NONE) {
		session_start();
	}
    
    if(!isset($session_text)){
        $session_text = ""; // Hangi bilgiyi kontrol edeceğine karar verir
    }

    if(!isset($mode)){
        $mode = 1;// Varsayılan giriş yapılmışsa Gösterir
    }
    
    if(!isset($page)){
        $page = "login.php";// Varsayılan login.php sayfasına yönlendirir
    }
    // Doktor zaten oturum açmamışsa giriş sayfasına yönlendir
    if(isset($_SESSION[$session_text]) == !$mode) {
        header("Location: $page");
        die();
    }
?>