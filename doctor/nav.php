<?php
	include("../templates/navgenerate.php");

	if (session_status() == PHP_SESSION_NONE) {
		session_start();
	}

    if(isset($_SESSION['d_email'])) {
		addLogoToNav("index.php");
		addToNAV("
			<div class=\"main-menu\">
				<nav class=\"navigation\">
					<ul class=\"nav menu\">
						<li ><a href=\"./appointments.php\">Randevularım</a></li>
				</nav>
			</div>
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