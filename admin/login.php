<?php

session_start();

//echo var_dump($_GET);
//echo var_dump($_SESSION);

if (isset($_GET['action']) && $_GET['action'] == "login" && !isset($_SESSION['a_email'])) {
	//Login aksiyonu
	if(!isset($_SESSION['a_email'])){
		// E-posta ve şifre al
		$email = $_POST['email'];
		$password = $_POST['password'];
		
		include ('../database.php');

		$sql = "SELECT * FROM admins WHERE email = '$email' AND password = '$password'";
		$result = $database->query($sql);

		if ($result->num_rows > 0) {
			// Oturumu başlat
			$_SESSION['a_email'] = $email;
			header("Location: index.php");
			die();
		} else {
			//Mesaj gönder
			$msg = array("type"=>"alert-danger","text"=>"E-posta veya şifre hatalı.");
		}
	} else {
		// Zaten giriş yapılmış 
		header("Location: index.php");
		die();
	}
} else if(isset($_GET['action']) && $_GET['action'] == "logout" && isset($_SESSION['a_email'])){
	//Logout aksiyonu
	unset($_SESSION['a_email']);
	header("Location: login.php");
	die();
} else if(isset($_SESSION['a_email'])){
	header("Location: index.php");
	die();
}
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
		
		<!-- Header Area -->
		<header class="header" >
			<!-- Header Inner -->
			<div class="header-inner">
				<div class="container">
					<div class="inner">
						<div class="row">
							<div class="col-lg-3 col-md-3 col-12">
								<!-- Start Logo -->
								<div class="logo">
									<a href="/index.php"><img src="/img/logo.png" alt="#"></a>
								</div>
								<!-- End Logo -->
								<!-- Mobile Nav -->
								<div class="mobile-nav"></div>
								<!-- End Mobile Nav -->
							</div>
							<div class="col-lg-7 col-md-9 col-12">
								<!-- Main Menu -->
								<div class="main-menu">
									<nav class="navigation">
										<ul class="nav menu">
											<li class="active"><a href="/#">anasayfa <i class="icofont-rounded-down"></i></a>
												<ul class="dropdown">
													<li><a href="/index.php">anasayfa 1</a></li>
												</ul>
											</li>
											<li><a href="/doktorlar.php">doktorlar </a></li>
											<li><a href="/doktorlar">Servislerimiz </a></li>
											<li><a href="/#">sayfalar <i class="icofont-rounded-down"></i></a>
												<ul class="dropdown">
													<li><a href="/404.php">404 Error</a></li>
												</ul>
											</li>
											<li><a href="/#">Blogs <i class="icofont-rounded-down"></i></a>
												<ul class="dropdown">
													<li><a href="/blog-single.html">Blog Details</a></li>
												</ul>
											</li>
											<li><a href="/contact.html">bize ulaşın</a></li>
										</ul>
									</nav>
								</div>
								<!--/ End Main Menu -->
							</div>
							<div class="col-lg-2 col-12">
								<div class="get-quote">
									<a href="/appointment.html" class="btn">randevu al</a>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
			<!--/ End Header Inner -->
		</header>

        <!--Login Screen -->
		<?php
			include("../templates/login.php");
		?>
		<!--login screen-->

		<?php
			include("../templates/importfooter.php");
			include("../templates/importjs.php");
		?>
    </body>
</html>
