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

        // Doktorları veritabanından al ve uygun olanları filtrele
        $sql = "SELECT 
        das.doctors.*,das.citys.name AS 'city_name',doctor_specialtys.name AS 'doctor_specialty_name',doctor_degrees.name AS doctor_degree_name
        FROM
        das.doctors
            JOIN
        das.citys ON das.doctors.city_id = citys.id
            JOIN
        doctor_specialtys ON doctors.doctor_specialty_id = doctor_specialtys.id 
                join doctor_degrees on doctors.doctor_degree_id=doctor_degrees.id    
                WHERE das.citys.id = $sehir and doctor_specialtys.id= $doctor_specialty";
        $result = $database->query($sql);
            echo "<div class='container margin-tb-5rem' >";

        // Sonucu ekrana yazdır
        if ($result->num_rows > 0) {
    
            echo "<p>";
            while($row = $result->fetch_assoc()) {
                echo $row['name'] . " " . $row['surname'] . " - " . $row['doctor_specialty_name'] ." - ". $row['doctor_degree_name'];
                echo "<br>";
                // tasarım ve takvim buraya
        
            }
            echo "</p>";
   
    
        } else {
    
            echo "<div>";
            echo "<div class='alert alert-warning' role='alert'>Uygun doktor bulunamadı.</div></div>"; //alert
  
        }
            echo "</div>";

        ?>

		<?php
			include("../templates/importfooter.php");
			include("../templates/importjs.php");
		?>
    </body>
</html>