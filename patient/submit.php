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