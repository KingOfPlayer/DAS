<?php
	include("./templates/navgenerate.php");

	addLogoToNav("index.php");

	/*addToNAV("
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
	");*/

	addToNAV("
		<div class=\"col-lg-3 col-12 d-flex\">
			<a href=\"./patient/login.php\" class=\"btn btn-primary btn-block text-light me-3\">Hasta Girişi</a>
			<a href=\"./doctor/login.php\" class=\"btn btn-primary btn-block text-light me-3\">Doktor Girişi</a>
		</div>
	");
			
	printNav();
?>