<?php
// Veritabanı bağlantısı
$servername = "localhost";
$username = "root";
$password = "1234";
$dbname = "DAS";

$conn = new mysqli($servername, $username, $password, $dbname);

// Bağlantı kontrolü
if ($conn->connect_error) {
    die("Veritabanı bağlantısı başarısız: " . $conn->connect_error);
}

// Şehirleri veritabanından al
$sql = "SELECT * FROM city";
$result = $conn->query($sql);
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
											<li class="active"><a href="/#">anasayfa </a></li>
											<li><a href="/doktorlar.php">doktorlar </a></li>
											<li ><a href="/doktorlar">randevularım </a></li>
											<li  ><div style="margin-top: 20px;">
                                           <button class="btn btn-primary">çıkış yap</button>
                                            </div> </li> 
											
										
									</nav>
								</div>
								<!--/ End Main Menu -->
							</div>
						</div>
					</div>
				</div>
			</div>
			<!--/ End Header Inner -->
		</header>

        <!--arama alanı -->
        
        
        
        <div class="container margin-5rem">
			<div class="row justify-content-center mt-5">
            <div>
           
        <form action="submit.php" method="post">
            <label for="sehir">  Şehir Seçin:   </label>
            <select id="sehir" name="sehir">
                <?php
                if ($result->num_rows > 0) {
                    while($row = $result->fetch_assoc()) {
                        echo "<option value='" . $row['id'] . "'>" . $row['name'] . "</option>";
                    }
                } else {
                    echo "<option value='-1'>Veri bulunamadı</option>";
                }
                ?>
            </select>
            <input class="btn btn-primary" type="submit" value="Gönder">
        </form>
    </div>
        
        
        
        
        
        
        </div>
        
    
    </div>
	<!--arama alanı-->

		<?php
			include("../templates/importfooter.php");
			include("../templates/importjs.php");
		?>
    </body>
</html>
