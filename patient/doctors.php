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
		return "/doctor/profile-imgs/$imguid";
	}
}

if (isset($_GET['action']) && $_GET['action'] == "search") {
	
	// Formdan gelen verileri al
	$sehir = $_POST['city'];
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

	try{
		// Sorguyu çalıştır
		$result = $database->query($sql);
		if ($result->num_rows > 0) {
	
			while($row = $result->fetch_assoc()) {
				
				echo "<div class=\"w-50 d-flex justify-content-center pb-5\">
						<div class=\"card doctor-card\" style=\"width: 18rem;\">
							<div class=\"justify-content-center d-flex\">
								<img src=\"".getImg($row['imguid'],$row['gender'])."\" class=\"card-img-top rounded w-au w-50\" alt=\"" . $row['name'] . " " . $row['surname'] . "\">
							</div>
							<div class=\"card-body\">
								<h5 class=\"card-title border-bottom px-3\">" . $row['name'] . " " . $row['surname'] . "</h5>
								<p class=\"card-text px-2\">Uzmanlık Alanı: " . $row['specialty_name'] . "</p>
								<p class=\"card-text px-2\">Unvanı: " . $row['degree_name'] . "</p>
								<p class=\"card-text px-2\">E-posta: " . $row['email'] . "</p>
								<p class=\"card-text px-2\">Telefon Numarası: " . $row['phone_number'] . "</p>
							</div>
						</div>
					</div>";
										//<a href=\"#\" class=\"btn btn-primary\">Go somewhere</a>
			}
		} else {
			echo "<div class='alert alert-warning w-100 mx-5' role='alert'>Uygun doktor bulunamadı.</div>"; //alert
		}
	}catch(Exception $e){
		echo "
			<div class=\"alert alert-danger w-100 mx-5\" role=\"alert\">
				Bir şeyler yanlış gitti
			</div>
			";
	}
	die();
}else{
	// Şehirleri veritabanından al
	$sql_citys = "SELECT * FROM citys";
	$sql_doctor_specialtys= "select * from doctor_specialtys";
	$citys = $database->query($sql_citys);
	$doctor_specialtys = $database->query($sql_doctor_specialtys);
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
					<h1>Doktrolar</h1>
				</div>
                <div >
		            <div class="container my-2 px-5 border-bottom">
                        <div class="row justify-content-center">
                            <form action="submit.php" method="post">
                                <div class="row">
									<div class="form-group pb-3 d-flex flex-column col-sm">
										<label for="city" class="ps-3">Şehir</label>
										<select class="d-flex align-items-center ps-3 mb-0" style="display: none !important;" id="city" name="city" required>
											<?php
												echo "<option value=\"\" disabled selected>Şehir Seçiniz</option>";
												if ($citys->num_rows > 0) {
													while($row = $citys->fetch_assoc()) {
														echo "<option value='" . $row['id'] . "'>" . $row['name'] . "</option>";
													}
												} else {
													echo "<option value='-1'>Veri bulunamadı</option>";
												}
											?>
										</select>
									</div>
                                    <div class="form-group pb-3 px-3 d-flex flex-column col-sm">
										<label for="doctor_specialty" class="ps-3">Uzmanlık Alanı</label>
										<select class="d-flex align-items-center ps-3 mb-0" style="display: none !important;" id="doctor_specialty" name="doctor_specialty" required>
											<?php
												echo "<option value=\"\" disabled selected>Uzmanlık Alanı Seçiniz</option>";
												if ($doctor_specialtys->num_rows > 0) {
													while($row = $doctor_specialtys->fetch_assoc()) {
														echo "<option value='" . $row['id'] . "'>" . $row['name'] . "</option>";
													}
												} else {
													echo "<option value='-1'>Veri bulunamadı</option>";
												}
											?>
										</select>
									</div>
									<div class="form-group pb-3 px-3 d-flex flex-column col-sm text-center">
										<button type="submit" class="btn btn-primary mt-3">Ara</button>
									</div>
                                </div>
                            </form>
                        </div>
                    </div>
					<div id="query" class="d-flex flex-wrap py-4">
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
				document.getElementById("query").innerHTML = "";
				$("form").submit(function (event) {
				let formData = {
					city: $("#city").val(),
					doctor_specialty: $("#doctor_specialty").val()
				};

				$.ajax({
					type: "POST",
					url: "doctors.php?action=search",
					data: formData,
					dataType: "text",
					encode: true,
				}).done(function (data) {
					document.getElementById("query").innerHTML = data;
				});

				event.preventDefault();
				});
			});
		</script>
    </body>
</html>
