<?php

if (session_status() == PHP_SESSION_NONE) {
	session_start();
}

//echo var_dump($_GET);
//echo var_dump($_SESSION);

if (isset($_GET['action']) && $_GET['action'] == "login" && !isset($_SESSION[$session_text])) {
	//Login aksiyonu
	if(!isset($_SESSION[$session_text])){
		// E-posta ve şifre al
		$email = $_POST['email'];
		$password = $_POST['password'];
		
		include ('../database.php');

		$sql = "SELECT * FROM $database_table_name WHERE email = '$email' AND password = '$password'";
		$result = $database->query($sql);

		if ($result->num_rows > 0) {
			// Oturumu başlat
			$_SESSION[$session_text] = $email;
			header("Location: index.php");
			die();
		} else {
			//Mesaj gönder
			$msg = array("type"=>"alert-danger","text"=>"E-posta veya şifre hatalı.");
		}
	} else {
		// Zaten giriş yapılmış 
		header("Location: index.php");
		die();
	}
} else if(isset($_GET['action']) && $_GET['action'] == "logout" && isset($_SESSION[$session_text])){
	//Logout aksiyonu
	unset($_SESSION[$session_text]);
	header("Location: login.php");
	die();
}
?>