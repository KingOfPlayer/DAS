<?php
	include("../templates/navgenerate.php");

	if (session_status() == PHP_SESSION_NONE) {
		session_start();
	}

    if(isset($_SESSION['p_email'])) {
		addLogoToNav("index.php");
		/*addToNAV("
			<div class=\"col-lg-2 col-12\">
					<h3>Logined</h3>
			</div>
		");*/
		addToNAV("
			<!-- Main Menu -->
			<div class=\"main-menu\">
				<nav class=\"navigation\">
					<ul class=\"nav menu\">
						<li><a href=\"./doctors.php\">Doktorlar</a></li>
						<li ><a href=\"./appointments.php\">Randevularım</a></li>
				</nav>
			</div>
			<!--/ End Main Menu -->
		");

		addToNAV("
			<div class=\"col-lg-2 col-12\">
				<a href=\".\login.php?action=logout\" class=\"btn btn-primary btn-block text-light\">Çıkış Yap</a>
			</div>
		");
    }else{
		addLogoToNav("/index.php");
		$splited_url = explode("/",$_SERVER['REQUEST_URI']);
		$file_name = end($splited_url);

		if($file_name == "newaccount.php"){
			addToNAV("
				<div class=\"col-lg-2 col-12\">
					<a href=\".\login.php\" class=\"btn btn-primary btn-block text-light\">Giriş Yap</a>
				</div>
			");
		}
	}
			
	printNav();
?>