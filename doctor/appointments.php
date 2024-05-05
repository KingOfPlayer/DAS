<?php
// Eğer dosya doktor,hasta,admindeyse bunu ekle
$session_text = "d_email";
include("../templates/logincheck.php");

// Veritabanı bağlantısı
include ('../database.php');

// Doktor ID'sini al (Örneğin, $_GET veya $_POST ile)
$email = $_SESSION['d_email']; // Örnek olarak POST kullanıldı, gerektiğinde değiştirilebilir.

// Sorguyu hazırla
 $sql = "SELECT patients.name AS patient_name, appointments.id AS appointment_id, appointments.take_date, appointment_times.date, appointment_times.time,
doctors.name AS doctor_name, doctor_specialtys.name AS specialty_name, citys.name AS city_name ,patients.surname AS patient_surname
FROM patients
INNER JOIN appointments ON patients.id = appointments.patients_id
INNER JOIN appointment_times ON appointments.appointment_times_id = appointment_times.id
INNER JOIN doctors ON appointment_times.doctor_id = doctors.id
INNER JOIN doctor_specialtys ON doctors.doctor_specialty_id = doctor_specialtys.id
INNER JOIN citys ON doctors.city_id = citys.id
WHERE doctors.email = '$email' ORDER BY appointment_times.date, appointment_times.time";

 $sql = "SELECT 
    das.patients.name AS patient_name,
    das.appointments.take_date,
    das.appointment_times.date,
    doctors.name AS doctor_name,
    patients_city.name AS patients_city_name,
    patients.surname AS patient_surname
FROM
    das.appointment_times
        LEFT JOIN
    das.appointments ON das.appointments.appointment_times_id = das.appointment_times.id
        LEFT JOIN
    das.patients ON das.appointments.patients_id = das.patients.id
        LEFT JOIN
    das.doctors ON das.appointment_times.doctor_id = das.doctors.id
        LEFT JOIN
    das.citys as doctors_city ON das.doctors.city_id = doctors_city.id
        LEFT JOIN
    das.citys as patients_city ON das.patients.city_id = patients_city.id
		WHERE
	das.doctors.email = '$email'";

// Sorguyu çalıştır
$result = $database->query($sql);
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

		<!-- Buradan Başla -->
        <div class="container border-start border-end" style="display: flow-root;">
		    <div class="my-5 px-5">
				<div class="d-flex p-5 pb-0 border-bottom">
					<h1>Randevularım</h1>
				</div>
                <div >
		            <?php
                    // Sonucu kontrol et
                    echo '<div class="card-columns p-2">';
                    if ($result->num_rows > 0) {
                        // Randevuları kartlar içinde göster
                        while($row = $result->fetch_assoc()) {
                            echo '<div class="card mb-2">';
                                echo '<div class="card-body">';

                                echo "<h5 class='card-title border-bottom'>Hasta: " . $row['patient_name'] ." ".$row['patient_surname']. "</h5>";
                                    echo "<p class='card-text'>Randevu Tarihi: " . $row['date'] . "</p>";
                                    // abi buraya hasta bilgisi ekleyelim mi boş duruyor çünkü bootstrap kullandım seni mi kıracağım 
                                echo '</div>';
                            echo '</div>';
                        }
                    } else {
                        // Randevu bulunamadı
                        echo "<p class='alert alert-warning'> Randevunuz bulunmamaktadır.</p>";
                    }
                    echo '</div>';
                    // Veritabanı bağlantısını kapat
                    $database->close();
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