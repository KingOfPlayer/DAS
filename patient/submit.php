<!doctype html>
<html class="no-js" lang="zxx">
    <head>
		<?php
			include("../templates/importcss.php");
		?>
		<style> 
.doctor-cards {
    display: flex;
    flex-wrap: wrap;
    gap: 20px;
}

.doctor-card {
    border: 1px solid #ccc;
    border-radius: 8px;
    padding: 20px;
    width: 250px; /* Kart boyutunu genişlettim */
    background-color: #f9f9f9;
    box-shadow: 0 0 5px rgba(0, 0, 0, 0.1);
}

.doctor-card p {
    margin: 5px 0;
    font-size: 16px;
}

</style>
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

// Veritabanına bağlantıyı sağlayın (bu kısmı sizin bağlantı yönteminize göre güncelleyin)

// Sorguyu hazırla
$sql = "SELECT 
    doctors.*, citys.name AS 'city_name', doctor_specialtys.name AS 'specialty_name', doctor_degrees.name AS 'degree_name' 
    FROM
    doctors
    JOIN
    citys ON doctors.city_id = citys.id
    JOIN
    doctor_specialtys ON doctors.doctor_specialty_id = doctor_specialtys.id 
    JOIN
    doctor_degrees ON doctors.doctor_degree_id = doctor_degrees.id
	
    WHERE citys.id = $sehir AND doctor_specialtys.id = $doctor_specialty";

// Sorguyu çalıştır
$result = $database->query($sql);

// Sonucu ekrana yazdır
if ($result->num_rows > 0) {
	
	while($row = $result->fetch_assoc()) {
		
		echo '<div class="doctor-card">';
		echo "<p>" . $row['name'] . " " . $row['surname'] . "</p>";
		echo "<p>Uzmanlık Alanı: " . $row['specialty_name'] . "</p>";
		echo "<p>Unvanı: " . $row['degree_name'] . "</p>";
	
		echo '</div>';
		echo "<br>";
	}
	echo '</div>';
   
    
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