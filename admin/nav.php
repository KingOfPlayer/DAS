<?php
	include("../templates/navgenerate.php");
	$test = "
		<div class=\"col-lg-2 col-12\">
				<a href=\"/appointment.html\" class=\"btn\">randevu al</a>
		</div>
	";
			
	addLogoToNav("index.php");
	addToNAV($test);
	dumpNav();
?>