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
		


        <div class="container margin-tb-5rem">
			<div class="row justify-content-center mt-5">
				<div class="col-md-6">
					<div class="card">
						<div class="card-header text-center">Hoş Geldiniz</div>
						
					</div>
					<?php
// Veritabanı bağlantısı
include ('../database.php');
$email=$_SESSION['p_email'];
$sql = "SELECT patients.name AS patient_name, appointments.id AS appointment_id, appointments.take_date, appointment_times.date, appointment_times.time,
                doctors.name AS doctor_name, doctor_specialtys.name AS specialty_name, citys.name AS city_name
        FROM patients
        INNER JOIN appointments ON patients.id = appointments.patients_id
        INNER JOIN appointment_times ON appointments.appointment_times_id = appointment_times.id
        INNER JOIN doctors ON appointment_times.doctor_id = doctors.id
        INNER JOIN doctor_specialtys ON doctors.doctor_specialty_id = doctor_specialtys.id
        INNER JOIN citys ON doctors.city_id = citys.id
        WHERE patients.email = '$email'";
		$result = $database->query($sql);

		// Sonucu kontrol et
		if ($result->num_rows > 0) {
			// Kayıt bulundu, bilgileri ekrana yazdır
			while($row = $result->fetch_assoc()) {
				echo "<p>Patient Name: " . $row['patient_name'] . "</p>";
				echo "<p>Appointment ID: " . $row['appointment_id'] . "</p>";
				echo "<p>Appointment Date: " . $row['date'] . "</p>";
				echo "<p>Appointment Time: " . $row['time'] . "</p>";
				echo "<p>Doctor Name: " . $row['doctor_name'] . "</p>";
				echo "<p>Specialty: " . $row['specialty_name'] . "</p>";
				echo "<p>City: " . $row['city_name'] . "</p>";
			}
		} else {
			// Kayıt bulunamadı
			echo "randevu kayıdınız bulunamadı.";
		}
		?>
				</div>
			</div>
		</div>

		<?php
			include("../templates/importfooter.php");
			include("../templates/importjs.php");
		?>
    </body>
</html>