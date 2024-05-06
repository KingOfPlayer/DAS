<?php
// Eğer dosya doktor,hasta,admindeyse bunu ekle
$session_text = "d_email";
include("../templates/logincheck.php");

// Veritabanı bağlantısı
include ('../database.php');

// Doktor ID'sini al (Örneğin, $_GET veya $_POST ile)
$email = $_SESSION['d_email']; // Örnek olarak POST kullanıldı, gerektiğinde değiştirilebilir.

// Sorguyu hazırla
 $sql = "SELECT 
    das.patients.name AS patient_name,
    das.patients.email AS patient_email,
    das.patients.phone_number AS patient_phone_number,
    das.appointments.take_date,
    das.appointments.id AS appointment_id,
    das.appointment_status.id AS appointment_status_id,
    das.appointment_times.id,
    das.appointment_times.date,
    das.appointment_times.online,
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
        LEFT JOIN
    appointment_status ON appointments.appointment_status_id = appointment_status.id
		WHERE
	das.doctors.email = '$email'";

// Sorguyu çalıştır
$result = $database->query($sql);

    
function boolToElement($bool,$true_element,$false_element){
    if($bool==1){
        return $true_element;
    }else{
        return $false_element;
    }
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
                            /*echo '<div class="card mb-2">';
                                echo '<div class="card-body">';

                                echo "<h5 class='card-title border-bottom'>Hasta: " . $row['patient_name'] ." ".$row['patient_surname']. "</h5>";
                                    echo "<p class='card-text'>Randevu Tarihi: " . $row['date'] . "</p>";
                                    // abi buraya hasta bilgisi ekleyelim mi boş duruyor çünkü bootstrap kullandım seni mi kıracağım 
                                echo '</div>';
                            echo '</div>';*/
                            /*
                            echo "<div class=\"alert alert-primary m-3\" role=\"alert\">";
                                echo "<h3 class=\"border-bottom border-primary px-4\">Randevu Tarihi: " . $row['date'] . "</h3>";
                                echo "<p class=\"px-2 my-1\">Hasta Adı: " . $row['patient_name'] ." ".$row['patient_surname']. "</p>";
                                echo "<p class=\"px-2 my-1\">Randevu tipi: " . boolToElement($row['online'],"Uzaktan","Yüzyüze") . "</p>";
                                echo "<p class=\"px-2 my-1\">Randevuyu aldığı tarih: " . $row['take_date'] . "</p>";
                                echo "<p class=\"px-2 my-1\">E-posta: " . $row['patient_email'] . "</p>";
                                echo "<p class=\"px-2 my-1\">Telefon Numarası: " . $row['patient_phone_number'] . "</p>";
						        echo "<a href=\"editappointment.php?action=edit&id=".$row['id']."\" class=\"btn btn-primary w-100 text-light\">Randevuyu değiştir</a>";
                            echo " </div>";*/

                            $alert_type = "";
                            if($row['appointment_status_id']==1){
                                $alert_type = "alert-primary";
                            }else if($row['appointment_status_id']==2){
                                $alert_type = "alert-success";
                            }else if($row['appointment_status_id']==3){
                                $alert_type = "alert-secondary";
                            }else if($row['appointment_status_id']==4){
                                $alert_type = "alert-warning";
                            }else{
                                $alert_type = "alert-info";
                            }

                            echo "<div class=\"alert $alert_type m-3\" role=\"alert\">";
                                echo "<h3 class=\"border-bottom border-primary px-4\">Randevu Tarihi: " . $row['date'] . "</h3>";
                                echo "<p class=\"px-2 my-1\">Hasta Adı: " . $row['patient_name'] ." ".$row['patient_surname']. "</p>";
                                echo "<p class=\"px-2 my-1\">Randevu tipi: " . boolToElement($row['online'],"Uzaktan","Yüzyüze") . "</p>";
                                echo "<p class=\"px-2 my-1\">Randevuyu aldığı tarih: " . $row['take_date'] . "</p>";
                                echo "<p class=\"px-2 my-1\">E-posta: " . $row['patient_email'] . "</p>";
                                echo "<p class=\"px-2 my-1\">Telefon Numarası: " . $row['patient_phone_number'] . "</p>";
                                if($row['appointment_status_id']==1){
                                    echo "<button type=\"button\" href=\"appointments.php?action=edit&appointment_id=".$row['appointment_id']."\" class=\"btn btn-primary w-100 text-light\">Randevuyu İptal Et</button>";
                                }else if($row['appointment_status_id']==2){
                                    echo "<p class=\"px-2 my-1 text-success\">Randevu Gerçekleşti</p>";
                                }else if($row['appointment_status_id']==3){
                                    echo "<p class=\"px-2 my-1 text-secondary\">Randevu Gerçekleşmedi</p>";
                                }else if($row['appointment_status_id']==4){
                                    echo "<p class=\"px-2 my-1 text-warning\">Randevu İptal</p>";
                                }else{
                                    echo "<p class=\"px-2 my-1 text-info\">Henüz Randevuyu alan yok</p>";
                                }
						     echo " </div>";
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