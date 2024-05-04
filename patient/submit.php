<?php

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
echo '<div class="container my-5">';
if ($result->num_rows > 0) {
	
	while($row = $result->fetch_assoc()) {
		
		echo '<div class="doctor-card">';
		echo "<p>" . $row['name'] . " " . $row['surname'] . "</p>";
		echo "<p>Uzmanlık Alanı: " . $row['specialty_name'] . "</p>";
		echo "<p>Unvanı: " . $row['degree_name'] . "</p>";
	
		echo '</div>';
		echo "<br>";
	}
} else {
    
    echo "<div class='alert alert-warning m-5' role='alert'>Uygun doktor bulunamadı.</div>"; //alert
  
}
echo '</div>';



// Veritabanı bağlantısını kapat

?>

		<?php
			include("../templates/importfooter.php");
			include("../templates/importjs.php");
		?>
    </body>
</html>