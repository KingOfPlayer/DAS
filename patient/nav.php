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
						<li class=\"active\"><a href=\"/#\">anasayfa </a></li>
						<li><a href=\"/doktorlar.php\">doktorlar </a></li>
						<li ><a href=\"/doktorlar\">randevularım </a></li>
						<li  ><div style=\"margin-top: 20px;\">
                        </div> </li>			
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
	}
			
	printNav();
?>