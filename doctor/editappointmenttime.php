<?php
// Eğer dosya doktor,hasta,admindeyse bunu ekle
$session_text = "p_email";
include("../templates/logincheck.php");

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

		<!-- Buradan Başla -->
		<div class="container border-start border-end" style="display: flow-root;">
		    <div class="my-5 p-5">
				<!-- Buradan Başla -->
		    </div>
		</div>


		<?php
			include("../templates/importfooter.php");
			include("../templates/importjs.php");
		?>
    </body>
</html>