<?php

$session_text = "p_email";
include("../templates/logincheck.php");

// Veritabanı bağlantısı
include ('../database.php');

function getImg($imguid,$gender){
	if($imguid == NULL){
		if($gender == 'E'){
			return "/img/m.png";
		}else{
			return "/img/f.png";
		}
	}else{
		return $imguid;
	}
}

if (isset($_GET['action']) && $_GET['action'] == "search") {
	
	echo var_dump($_GET);

	$id = $_GET["id"];

	// Sorguyu hazırla
	$sql = "SELECT * FROM das.available_appointments WHERE doctor_id = $id";

	try{
		// Sorguyu çalıştır
		$available_appointments = $database->query($sql);
	}catch(Exception $e){
		die();
	}
	
}else if (isset($_GET['action']) && $_GET['action'] == "getappointment") {

	$appointmentid = $_GET["appointmentid"];
	$sql = "INSERT INTO `das`.`appointments` (`take_date`, `payment`, `appointment_status_id`, `patients_id`, `appointment_times_id`) 
									VALUES (NOW(), 0, '1', (SELECT patients.id FROM patients WHERE patients.email = '".$_SESSION[$session_text]."'), $appointmentid);
";
	try{
		// Sorguyu çalıştır
		$result = $database->query($sql);
		echo "btn-success";
	}catch(Exception $e){
		echo "btn-danger";
	}
	die();
}

?>

<?php
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

        <!--arama alanı -->
        <div class="container border-start border-end" style="display: flow-root;">
		    <div class="my-5 px-5">
				<div class="d-flex p-5 pb-0 border-bottom">
					<h1>Randevu Al</h1>
				</div>
                <div class="mb-5 mt-2 px-5 row justify-content-center">
					<div class="col-5 d-flex justify-content-center pe-5 pt-3">
						<div class="card doctor-card h-fc" style="width: 18rem;">
							<div class="justify-content-center d-flex">
								<img src="/img/m.png" class="card-img-top rounded w-au w-50" alt="Erkan HAZIR">
							</div>
							<div class="card-body">
								<h5 class="card-title border-bottom">Erkan HAZIR</h5>
								<p class="card-text">Uzmanlık Alanı: Genel Cerrahi</p>
								<p class="card-text">Unvanı: Pratisyen Doktor</p>
								<p class="card-text">En Yakın Randevu: 2024-04-04 14:56:00</p>
							</div>
						</div>
					</div>
					<div class="border-start col pb-4 pt-3">
						<div class="border-bottom mx-3 w-100 px-5">
							<h4 class="pb-2">Randevular</h4>
						</div>
						<div class="pt-3 px-5 w-100">
							<?php
								if ($available_appointments->num_rows > 0) {
									while($row = $available_appointments->fetch_assoc()) {
				
										echo "
											<div class=\"card doctor-card mb-3\" style=\"width: 100% !important;\">
												<div class=\"card-body\">
													<h5 class=\"card-title border-bottom\">".$row["date"]."</h5>
													<p class=\"card-text\">Ücret: ".$row["price"]."₺</p>
													<button type=\"button\" href=\"getdoctorappointments.php?action=getappointment&appointmentid=".$row["id"]."\" class=\"btn btn-primary w-100 text-light\">Randevuyu Al</button>
												</div>
											</div>";
																//<a href=\"#\" class=\"btn btn-primary\">Go somewhere</a>
									}
								} else {
									echo "<div class='alert alert-warning w-100 mx-5' role='alert'>Bu doktorun alınabilecek randevusu bulunamamaktadır</div>"; //alert
								}
							?>
						</div>
					</div>
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
						_button.classList.add(data);
						if(data=="btn-success"){
							_button.setAttribute("disabled", true);
						}
					});
				});
			});
		</script>
    </body>
</html>
