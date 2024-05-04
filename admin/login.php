<?php
$session_text = "a_email";
$mode = 0;
$page = "index.php";

$database_table_name = "admins";
include("../templates/login.php");

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

        <!--Login Screen -->
		<?php
			include("../templates/logincontainer.php");
			printLogin("Admin");
		?>
		<!--login screen-->

		<?php
			include("../templates/importfooter.php");
			include("../templates/importjs.php");
		?>
    </body>
</html>
