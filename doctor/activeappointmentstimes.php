<?php
// Eğer dosya doktor,hasta,admindeyse bunu ekle
$session_text = "d_email";
include("../templates/logincheck.php");
$mail = $_SESSION[$session_text];

include("../database.php");
$sql = "SELECT 
    das.appointment_times.id,
    das.appointment_times.date,
    das.appointment_times.time,
    das.appointment_times.price,
    das.appointment_times.online FROM das.appointment_times
JOIN das.doctors ON das.appointment_times.doctor_id = das.doctors.id WHERE das.doctors.email = '$mail' AND das.appointment_times.active;";
$appointments = $database->query($sql);


function boolToElement($bool,$true_element,$false_element){
    if($bool==1){
        return $true_element;
    }else{
        return $false_element;
    }
}

function printTD($data){
    echo "<td>$data</td>";
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
        <div class="container border-start border-end" style="display: flow-root;">
		    <div class="my-5 px-5">
				<div class="d-flex m-5 mb-0">
					<h1>Aktif Randevu Zamanları</h1>
				</div>
                <div class="card">
				    <!-- Appointments Table-->
			        <table class="table m-4 table-striped">
                        <thead>   
                            <tr>
                                <th scope="col">Tarih</th>
                                <th scope="col">Zaman</th>
                                <th scope="col">Ücret</th>
                                <th scope="col">Randevu Tipi</th>
                                <th scope="col"></th>
                                <th scope="col"></th>
                            </tr>
                        </thead>
                        <tbody id="tbody">
                            <?php
                                if ($appointments->num_rows > 0) {
                                    while($row = $appointments->fetch_assoc()) {
                                        echo "<tr>";
                                        printTD($row['date']);
                                        printTD($row['time']);
                                        printTD($row['price']);
                                        printTD(boolToElement($row['online'],"
                                        <p class=\"text-primary\">
                                             Online
                                        </p>
                                        ","<p class=\"text-primary\">
                                             Offline
                                        </p>"));
                                        printTD("
                                            <div class=\"btn-group\" role=\"group\",>
                                                <p><a class=\"link-offset-1 text-primary px-3\" href=\"editappointmenttime.php?id=". $row['id'] . "\">Düzenle</a></p>
                                                <p><a class=\"link-offset-1 text-danger px-3\" href=\"deleteappointmenttime.php?id=". $row['id'] . "\">Sil</a></p>
                                            </div>
                                        ");
                                        echo "</tr>";
                                    }
                                }
                            ?>
                        </tbody>
                    </table>
		        </div>
		    </div>
		</div>

		<?php
			include("../templates/importfooter.php");
			include("../templates/importjs.php");
		?>
    </body>
</html>