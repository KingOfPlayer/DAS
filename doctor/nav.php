<?php
	include("../templates/navgenerate.php");

	if (session_status() == PHP_SESSION_NONE) {
		session_start();
	}

    if(isset($_SESSION['d_email'])) {
		addLogoToNav("index.php");
		/*addToNAV("
			<div class=\"col-lg-2 col-12\">
					<h3>Logined</h3>
			</div>
		");*/

		addToNAV("
			<div class=\"col-lg-2 col-12\">
				<a href=\".\login.php?action=logout\" class=\"btn btn-primary btn-block text-light\">Çıkış Yap</a>
			</div>
		");
    }else{
		addLogoToNav("/index.php");
	}
			
	dumpNav();