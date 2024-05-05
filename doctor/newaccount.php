<?php
	// Eğer dosya doktor,hasta,admindeyse bunu ekle
	$session_text = "d_email";
	$mode = 0;
	$page = "index.php";
	include("../templates/logincheck.php");

	include("../database.php");

	if (isset($_GET['action']) && $_GET['action'] == "create") {
	
		$name = $_POST['name'];
		$surname = $_POST['surname'];
		$email = $_POST['email'];
		$password = $_POST['password'];
		$gender = $_POST['gender'];
		$city_id = $_POST['city'];
		$doctor_specialty_id = $_POST['doctorspecialty'];
		$doctor_degree_id = $_POST['doctordegree'];
		$phone_number = $_POST['phone_number'];

		include ('../database.php');

		$sql = "INSERT INTO `das`.`doctors` 
			(`name`, `surname`, `email`, `password`, `gender`, `city_id`, `doctor_specialty_id`, `doctor_degree_id`,`phone_number`) VALUES 
			('$name', '$surname', '$email', '$password', '$gender', $city_id, $doctor_specialty_id, $doctor_degree_id,'$phone_number');";
		try{
			$result = $database->query($sql);
			echo "
				<div class=\"alert alert-success mb-0\" role=\"alert\">
					Başarıyla yeni hesap oluşturuldu!
				</div>
				";
		}catch(Exception $e){
			echo $sql;
			echo $e;
			echo "
				<div class=\"alert alert-danger mb-0\" role=\"alert\">
					Bir şeyler yanlış gitti
				</div>
				";
		}
		die();
	}else{
		$sql = "SELECT * FROM das.citys";
		$citys = $database->query($sql);

		$sql = "SELECT * FROM das.doctor_specialtys";
		$doctor_specialtys = $database->query($sql);

		$sql = "SELECT * FROM das.doctor_degrees";
		$doctor_degrees = $database->query($sql);
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
			if(!isset($_GET['action'])){
				include("../templates/preloader.php");
			}
		?>
        <!-- End Preloader -->

		<!-- Nav -->
		<?php
			include("./nav.php");
		?>
        <!-- End Nav -->

		<!-- Buradan Başla -->
		<div class="container">
			<div class="container margin-tb-5rem">
				<div class="row justify-content-center mt-5">
					<div class="col-md-6">
						<div class="card">
							<div class="card-header text-center">
								<h5>
									Hesap Oluştur
								</h5>
							</div>
							<div class="card-body">
								<form action="newaccount.php?action=create" method="POST">
									<div class="row">
										<div class="form-group pb-3 px-3 ps-3 col-sm">
											<label for="name" class="ps-3">İsim</label>
											<input type="text" class="form-control px-3" id="name" name="name" pattern="[A-Z a-zıİşŞçÇöÖüÜ]{3,20}" title="Sadece harf kullanın" required>
										</div>
										<div class="form-group pb-3 px-3 ps-3 col-sm">
											<label for="surname" class="ps-3">Soyisim</label>
											<input type="text" class="form-control px-3" id="surname" name="surname" pattern="[A-Z a-zıİşŞçÇöÖüÜ]{3,20}" title="Sadece harf kullanın" required>
										</div>
									</div>
									<div class="row">
										<div class="form-group pb-3 px-3 ps-3 col-sm">
											<label for="email" class="ps-3">E-posta</label>
											<input type="email" class="form-control px-3" id="email" name="email" required>
										</div>
										<div class="form-group pb-3 px-3 ps-3 col-sm">
											<label for="password" class="ps-3">Şifre</label>
											<input type="password" class="form-control px-3" id="password" name="password" required>
										</div>
									</div>
									<div class="row">
										<div class="form-group pb-3 px-3 ps-3 col-sm">
											<label for="phone_number" class="ps-3">Telefon Numarası</label>
											<input type="text" class="form-control px-3" id="phone_number" name="phone_number" title="Telefon Numarası giriniz" pattern="[\+]?[(]?[0-9]{3}[)]?[-\s\.]?[0-9]{3}[-\s\.]?[0-9]{4,6}" required>
										</div>
									</div>
									<div class="row">
										<div class="form-group pb-3 px-3 d-flex flex-column col-sm">
											  <label for="city" class="ps-3">Şehir</label>
											  <select class="d-flex align-items-center ps-3 mb-0" style="display: none !important;" id="city" name="city">
													<?php
														echo "<option value='-1' disabled selected>Şehir Seçiniz</option>";
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
										<div class="px-3 pe-5 d-flex justify-content-center flex-column col-md-auto">
											<div class="form-check">
												<input class="form-check-input px-1" type="radio" name="gender" id="gender" value="E" checked>
												<label class="form-check-label" for="gender">
												Erkek
												</label>
											</div>
											<div class="form-check">
												<input class="form-check-input px-1" type="radio" name="gender" id="gender" value="K">
												<label class="form-check-label" for="gender">
												Kadın
												</label>
											</div>
										</div>
									</div>
									<div class="row">
										<div class="form-group pb-3 px-3 d-flex flex-column">
											  <label for="doctor_specialty" class="ps-3">Uzmanlık Alanınız</label>
											  <select class="d-flex align-items-center ps-3 mb-0" style="display: none !important;" id="doctorspecialty" name="doctorspecialty">
													<?php
														echo "<option value='-1' disabled selected>Uzmanlık Alanı Seçiniz</option>";
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
									</div>
									<div class="row">
										<div class="form-group pb-3 px-3 d-flex flex-column">
											  <label for="doctor_degree" class="ps-3">Ünvanınız</label>
											  <select class="d-flex align-items-center ps-3 mb-0" style="display: none !important;" id="doctordegree" name="doctordegree">
													<?php
														echo "<option value='-1' disabled selected>Ünvanı Seçiniz</option>";
														if ($doctor_degrees->num_rows > 0) {
															while($row = $doctor_degrees->fetch_assoc()) {
																echo "<option value='" . $row['id'] . "'>" . $row['name'] . "</option>";
															}
														} else {
															echo "<option value='-1'>Veri bulunamadı</option>";
														}
													?>
											  </select>
										</div>
									</div>
									<div id="msg" class="row pb-3 px-3">
									</div>
									
									<div class="row">
										<button type="submit" class="pb-3 mx-3 btn btn-primary btn-block w-100">Giriş Yap</button>
									</div>
								</form>
							</div>
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
				$("form").submit(function (event) {
				let formData = {
					name: $("#name").val(),
					surname: $("#surname").val(),
					email: $("#email").val(),
					password: $("#password").val(),
					city: $("#city").val(),
					gender: $("#gender").val(),
					doctorspecialty: $("#doctorspecialty").val(),
					doctordegree: $("#doctordegree").val(),
					phone_number: $("#phone_number").val(),
				};

				$.ajax({
					type: "POST",
					url: "newaccount.php?action=create",
					data: formData,
					dataType: "text",
					encode: true,
				}).done(function (data) {
					document.getElementById("msg").innerHTML = data;
				});

				event.preventDefault();
				});
			});
		</script>
    </body>
</html>