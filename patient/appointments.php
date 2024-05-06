<?php
$session_text = "p_email";
include("../templates/logincheck.php");


// Veritabanı bağlantısı
include ('../database.php');
$email=$_SESSION[$session_text];

if (isset($_GET['action']) && $_GET['action'] == "edit") {
	
    $id=$_GET['appointment_id'];
    $type=$_GET['type'];

    $sql = "UPDATE `das`.`appointments` SET `appointment_status_id` = '$type' WHERE (`id` = '$id');";
    try{
		// Sorguyu çalıştır
		$result = $database->query($sql);
        echo "1";
	}catch(Exception $e){
        echo "0";
	}
	die();
}else{
	// Şehirleri veritabanından al
$sql = "SELECT 
    patients.name AS patient_name,
    appointments.id AS appointment_id,
    appointment_status.id AS appointment_status_id,
    appointments.take_date,
    appointment_times.date,
    appointment_times.online,
    doctors.name AS doctor_name,
    doctors.surname AS doctor_surname,
    doctors.id AS doctor_id,
    doctor_specialtys.name AS specialty_name,
    citys.name AS city_name
FROM
    patients
        INNER JOIN
    appointments ON patients.id = appointments.patients_id
        INNER JOIN
    appointment_times ON appointments.appointment_times_id = appointment_times.id
        INNER JOIN
    doctors ON appointment_times.doctor_id = doctors.id
        INNER JOIN
    doctor_specialtys ON doctors.doctor_specialty_id = doctor_specialtys.id
        INNER JOIN
    citys ON doctors.city_id = citys.id
        INNER JOIN
    appointment_status ON appointments.appointment_status_id = appointment_status.id
WHERE
    patients.email = '$email'";
$result = $database->query($sql);
}


    
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
    <style>
        .appointment-info {
            background-color: #f0f8ff; /* Mavi arkaplan */
            border: 2px solid #4682b4; /* Mavi kenarlık */
            padding: 20px; /* Kenarlık içeriği ile arasındaki boşluk */
            border-radius: 10px; /* Yuvarlatılmış kenarlar */
            font-weight: bold; /* Kalın font */
        }

        .appointment-info p {
            margin: 10px 0; /* Paragraflar arası boşluk */
            font-size: 16px; /* Font boyutu */
            color: #333; /* Metin rengi */
        }
    </style>
    </head>
    <body>

        <!-- Preloader -->
        <?php
        include("../templates/preloader.php");
        ?>

        <!-- Nav -->
        <?php
        include("./nav.php");
        ?>
        <!-- End Nav -->

        <div class="container border-start border-end" style="display: flow-root;">
	        <div class="my-5 p-5">
		        <div class="d-flex p-5 pb-0 border-bottom">
			        <h1>Randevularım</h1>
		        </div>
                    <?php
                    // Sonucu kontrol et
                    if ($result->num_rows > 0) {
                        // Kayıt bulundu, bilgileri ekrana yazdır
                        while($row = $result->fetch_assoc()) {
                            $alert_type = "";
                            if($row['appointment_status_id']==1){
                                $alert_type = "alert-primary";
                            }else if($row['appointment_status_id']==2){
                                $alert_type = "alert-success";
                            }else if($row['appointment_status_id']==3){
                                $alert_type = "alert-secondary";
                            }else if($row['appointment_status_id']==4){
                                $alert_type = "alert-warning";
                            }
                            
                            echo "<div class=\"alert $alert_type m-3\" role=\"alert\">";
                                echo "<h3 class=\"border-bottom border-primary px-4\">Randevu Tarihi: " . $row['date'] . "</h3>";
                                echo "<p class=\"px-2 my-1\">Randevu numarası: " . $row['appointment_id'] . "</p>";
                                echo "<p class=\"px-2 my-1\">Doktor: <a class=\"px-2 my-1 text-primary\" href=\" getdoctorappointments.php?action=search&id=".$row['doctor_id']." \">" . $row['doctor_name'] . " " . $row['doctor_name'] . "</a></p>";
                                echo "<p class=\"px-2 my-1\">Uzmanlık: " . $row['specialty_name'] . "</p>";
                                echo "<p class=\"px-2 my-1\">Randevu tipi: " . boolToElement($row['online'],"Uzaktan","Yüzyüze") . "</p>";
                                if($row['online'] == 0){
                                    echo "<p class=\"px-2 my-1\">Şehir: " . $row['city_name'] . "</p>";
                                }
                                if($row['appointment_status_id']==1){
                                    echo "<button type=\"button\" href=\"appointments.php?action=edit&type=4&appointment_id=".$row['appointment_id']."\" class=\"btn btn-primary w-100 text-light\">Randevuyu İptal Et</button>";
                                }else if($row['appointment_status_id']==2){
                                    echo "<p class=\"px-2 my-1 text-success\">Randevu Gerçekleşti</p>";
                                }else if($row['appointment_status_id']==3){
                                    echo "<p class=\"px-2 my-1 text-secondary\">Randevu Gerçekleşmedi</p>";
                                }else if($row['appointment_status_id']==4){
                                    echo "<p class=\"px-2 my-1 text-warning\">Randevu İptal</p>";
                                }
						     echo " </div>";
                        }
                    } else {
                        // Kayıt bulunamadı
                            echo "<div class=\"alert alert-warning m-3\" role=\"alert\">";
                                echo "<p>Randevu kaydınız bulunamadı.</p>";
						    echo " </div>";
                    }
                    ?>
                </div>
            </div>
        </div>

        <?php
        include("../templates/importfooter.php");
        include("../templates/importjs.php");
        ?>
	    <script>
		    $(document).ready(function () {
			    $("button.btn.btn-primary.w-100.text-light").click(function() {
				    event.preventDefault();
				    let _button = this;
				    $.ajax({
					    type: "POST",
					    url: this.getAttribute("href"),
					    dataType: "text",
					    encode: true,
				    }).done(function (data) {
					    _button.className = "btn w-100 text-light";
					    if(data=="1"){
						    _button.classList.add("btn-success");
						    _button.setAttribute("disabled", true);
					    }else{
						    _button.classList.add("btn-danger");
					    }
				    });
			    });
		    });
	    </script>
    </body>
</html>
