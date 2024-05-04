<?php
// Eğer dosya doktor,hasta,admindeyse bunu ekle
$session_text = "d_email";
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

		<!-- Buradan Başla -->
		<?php
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

// Sorguyu çalıştır
$result = $database->query($sql);

// Sonucu kontrol et
if ($result->num_rows > 0) {
    // Randevuları kartlar içinde göster
    echo '<div class="card-columns">';
    while($row = $result->fetch_assoc()) {
        echo '<div class="card">';
        echo '<div class="card-body">';
        echo "<h5 class='card-title'>hasta: " . $row['patient_name'] ." ".$row['patient_surname']. "</h5>";
		
        echo "<p class='card-text'>Randevu Tarihi: " . $row['date'] . "</p>";
        echo "<p class='card-text'>Randevu Saati: " . $row['time'] . "</p>";
        // abi buraya hasta bilgisi ekleyelim mi boş duruyor çünkü bootstrap kullandım seni mi kıracağım 
        echo '</div>';
        echo '</div>';
    }
    echo '</div>';
} else {
    // Randevu bulunamadı
    echo "<p class='alert alert-warning'>Bu doktorun henüz randevusu bulunmamaktadır.</p>";
}
// Veritabanı bağlantısını kapat
$database->close();
?>

		<?php
			include("../templates/importfooter.php");
			include("../templates/importjs.php");
		?>
    </body>
</html>