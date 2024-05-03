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






















<?php
// Veritabanı bağlantısı
include ('../database.php');
// Formdan gelen verileri al

$sehir = $_POST['sehir'];
$doctor_specialty = $_POST['doctor_specialty'];

// Doktorları veritabanından al ve uygun olanları filtrele
$sql = "SELECT 
das.doctors.*,das.city.name AS 'city_name',doctor_specialty.name AS 'doctor_specialty_name',doctor_degree.name AS doctor_degree_name
FROM
das.doctors
    JOIN
das.city ON das.doctors.city_id = city.id
    JOIN
doctor_specialty ON doctors.doctor_specialty_id = doctor_specialty.id 
     join doctor_degree on doctors.doctor_degree_id=doctor_degree.id    
        WHERE das.city.id = $sehir and doctor_specialty.id= $doctor_specialty";
$result = $database->query($sql);

// Sonucu ekrana yazdır
if ($result->num_rows > 0) {
   
   
    while($row = $result->fetch_assoc()) {
        echo "<p>" . $row['name'] . " " . $row['surname'] . " - " . $row['doctor_specialty_name'] ."-". $row['doctor_degree_name']."</p>";
        echo "<br>.<br>";
      // tasarım ve takvim buraya
        
    }
   
    
} else {
    
    echo "<div class='alert alert-warning'>";
    echo "<div class='alert alert-warning' role='alert'>Uygun doktor bulunamadı.</div>"; //alert
  
}



// Veritabanı bağlantısını kapat

?>


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