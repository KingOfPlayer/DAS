<?php

session_start();

//echo var_dump($_GET);
//echo var_dump($_SESSION);

if (isset($_GET['action']) && $_GET['action'] == "login" && !isset($_SESSION['p_email'])) {
	//Login aksiyonu
	if(!isset($_SESSION['p_email'])){
		// E-posta ve şifre al
		$email = $_POST['email'];
		$password = $_POST['password'];
		
		include ('../database.php');

		$sql = "SELECT * FROM patients WHERE email = '$email' AND password = '$password'";
		$result = $database->query($sql);

		if ($result->num_rows > 0) {
			// Oturumu başlat
			$_SESSION['p_email'] = $email;
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
} else if(isset($_GET['action']) && $_GET['action'] == "logout" && isset($_SESSION['p_email'])){
	//Logout aksiyonu
	unset($_SESSION['p_email']);
	header("Location: login.php");
	die();
} else if(isset($_SESSION['p_email'])){
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
        <div class="preloader">
            <div class="loader">
                <div class="loader-outter"></div>
                <div class="loader-inner"></div>

                <div class="indicator"> 
                    <svg width="16px" height="12px">
                        <polyline id="back" points="1 6 4 6 6 11 10 1 12 6 15 6"></polyline>
                        <polyline id="front" points="1 6 4 6 6 11 10 1 12 6 15 6"></polyline>
                    </svg>
                </div>
            </div>
        </div>
        <!-- End Preloader -->

		<!-- Header Area -->
		<header class="header" >
			<!-- Topbar -->
			<div class="topbar">
				<div class="container">
					<div class="row">
						<div class="col-lg-6 col-md-5 col-12">
							<!-- Contact -->
							<ul class="top-link">
								<li><a href="/#">hakkımızda</a></li>
								<li><a href="/#">doktorlar</a></li>
								<li><a href="/#">iletişim</a></li>
								<li><a href="/#">SSS</a></li>
							</ul>
							<!-- End Contact -->
						</div>
						<div class="col-lg-6 col-md-7 col-12">
							<!-- Top Contact -->
							<ul class="top-contact">
								<li><i class="fa fa-phone"></i>0212-564-23-82</li>
								<li><i class="fa fa-envelope"></i><a href="/mailto:support@yourmail.com">support@yourmail.com</a></li>
							</ul>
							<!-- End Top Contact -->
						</div>
					</div>
				</div>
			</div>
			<!-- End Topbar -->
			<!-- Header Inner -->
			<div class="header-inner">
				<div class="container">
					<div class="inner">
						<div class="row">
							<div class="col-lg-3 col-md-3 col-12">
								<!-- Start Logo -->
								<div class="logo">
									<a href="/index.html"><img src="/img/logo.png" alt="#"></a>
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
        <div class="container">
			<div class="row justify-content-center mt-5">
				<div class="col-md-6">
					<div class="card">
						<div class="card-header text-center">Giriş Yap</div>
						<div class="card-body">
							<form action="login.php?action=login" method="POST">
								<div class="form-group">
									<label for="email">E-posta Adresi:</label>
									<input type="email" class="form-control" id="email" name="email" required>
								</div>
								<div class="form-group">
									<label for="password">Şifre:</label>
									<input type="password" class="form-control" id="password" name="password" required>
								</div>

								<?php
								//Mesaj bölümü 
									if (isset($msg)) {
										echo '<div class="alert ';
										echo $msg["type"];
										echo '" role="alert">';
										echo $msg["text"];
										echo '</div>';

										echo '<script>history.pushState({}, "", "login.php");</script>';
									}else{
										echo "<br>";
									}
								?>

								<button type="submit" class="btn btn-primary btn-block">Giriş Yap</button>
								<br>			
							</form>
							<br>
							<form action="logout.php" method="POST">
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
