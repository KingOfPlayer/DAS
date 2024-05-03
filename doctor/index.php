<?php

include("logincheck.php");

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
		
		<!-- Get Pro Button -->
		
		<!-- Nav -->
		<?php
			include("./nav.php");
		?>
        <!-- End Nav -->

        <!--Login Screen -->
        <div class="container margin-tb-5rem">
			<div class="row justify-content-center mt-5">
				<div class="col-md-6">
					<div class="card">
						<div class="card-header text-center">Giriş Yap</div>
						<div class="card-body">
							<form action="login.php?action=logout" method="POST">
								 <button class="btn btn-primary btn-block" type="submit">Oturumu Kapat</button>
							</form>
						</div>
					</div>
				</div>
			</div>
		</div>
		<!--login screen-->
		
		<?php
			include("../templates/importfooter.php");
			include("../templates/importjs.php");
		?>
    </body>
</html>