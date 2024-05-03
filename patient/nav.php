<?php
	include("../templates/navgenerate.php");

	session_start();

    if(isset($_SESSION['p_email'])) {
		addLogoToNav("index.php");
		addToNAV("
			<div class=\"col-lg-2 col-12\">
					<h3>Logined</h3>
			</div>
		");
    }else{
		addLogoToNav("/index.php");
	}
			
	dumpNav();
?>