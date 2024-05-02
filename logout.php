<?php
session_start(); // Oturumu başlat

// Oturumu sonlandır
session_unset();
session_destroy();

// Kullanıcıyı başka bir sayfaya yönlendir
header("Location: giriş.php"); // veya başka bir sayfaya yönlendirin
exit();
?>
