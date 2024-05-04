<?php
if (session_status() == PHP_SESSION_NONE) {
	session_start();
}
//echo var_dump($_GET);
//echo var_dump($_SESSION);

if (isset($_GET['action']) && $_GET['action'] == "login" && !isset($_SESSION['p_email'])) {
	//Login aksiyonu
	if(!isset($_SESSION['p_email'])){
		// E-posta ve şifre al
		$email = $_POST['email'];
		$password = $_POST['password'];
		
		include ('../database.php');

		$sql = "SELECT * FROM patients WHERE email = '$email' AND password = '$password'";
		$result = $database->query($sql);

		if ($result->num_rows > 0) {
			// Oturumu başlat
			$_SESSION['p_email'] = $email;
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
} else if(isset($_GET['action']) && $_GET['action'] == "logout" && isset($_SESSION['p_email'])){
	//Logout aksiyonu
	unset($_SESSION['p_email']);
	header("Location: login.php");
	die();
} else if(isset($_SESSION['p_email'])){
	header("Location: index.php");
	die();
}
?>


<!doctype html>
<html class="no-js" lang="zxx">
    <head>
		<?php
			include("../templates/importcss.php");
		?>
    </head>
    <body>
		<!-- Preloader -->
        <?php
			include("../templates/preloader.php");
		?>
        <!-- End Preloader -->
		
		<!-- Nav -->
		<?php
			include("./nav.php");
		?>
        <!-- End Nav -->

        <!--Login Screen -->
		<?php
			include("../templates/login.php");
			printLogin("Hasta","Hasta Olarak Giriş Yap");
		?>
		<!--login screen-->

		<?php
			include("../templates/importfooter.php");
			include("../templates/importjs.php");
		?>
    </body>
</html>
