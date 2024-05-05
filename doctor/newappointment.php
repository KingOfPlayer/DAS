<?php
	// Eğer dosya doktor,hasta,admindeyse bunu ekle
	$session_text = "d_email";
	include("../templates/logincheck.php");

	include("../database.php");

	if (isset($_GET['action']) && $_GET['action'] == "create") {
		
		$date = $_POST['date'];
		$price = $_POST['price'];
		$online = $_POST['online'];
		
		include ('../database.php');

		$sql = "INSERT INTO `das`.`appointment_times` (`date`, `price`, `online`, `active`, `doctor_id`) 
VALUES ('$date', '$price', '$online', '1', (SELECT das.doctors.id FROM das.doctors WHERE das.doctors.email = '".$_SESSION[$session_text]."'));";
		try{
			$result = $database->query($sql);
			echo "
				<div class=\"alert alert-success mb-0\" role=\"alert\">
					Başarıyla yeni randevu zamanı oluşturuldu!
				</div>
				";
		}catch(Exception $e){
			echo $e;
			echo $date;
			echo "
				<div class=\"alert alert-danger mb-0\" role=\"alert\">
					Bir şeyler yanlış gitti
				</div>
				";
		}
		die();
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
					<div class="col-md-9">
						<div class="card">
							<div class="card-header text-center">
								<h5>
									Yeni Randevu oluştur
								</h5>
							</div>
							<div class="card-body">
								<form method="POST">
									<div class="row">
										<div class="form-group pb-3 px-3 ps-3 col-sm">
											<label for="date" class="ps-3">Tarih</label>
											<?php
												$now = new DateTime('NOW');
												echo "<input type=\"datetime-local\" class=\"form-control px-3\" min=\"".$now->format('Y-m-d')."\"";
												$now->add(new DateInterval('P3M')); 
												echo "max=\"".$now->format('Y-m-d')."\" name=\"date\" id=\"date\" required>";
											?>
										</div>
									</div>
									<div class="row">
										<div class="form-group pb-3 px-3 ps-3 col-sm">
											<label for="price" class="ps-3">Ücret</label>
											<input type="number" class="form-control px-3" id="price" name="price" required>
										</div>
										<div class="px-3 pe-5 d-flex justify-content-center flex-column col-md-auto">
											<div class="form-check">
												<input class="form-check-input" type="checkbox" id="online">
												<label class="form-check-label" for="online">
													Çevrimiçi
												</label>
											</div>
										</div>
									</div>
									<div id="msg" class="row pb-3 px-3">
									</div>
									
									<div class="row pb-3 px-3">
										<button type="submit" class="pb-3 mx-0 btn btn-primary btn-block w-100">Giriş Yap</button>
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
				let date = new Date($("#date").val());

				let formData = {
					date: date.getFullYear()+"-"+date.getMonth()+"-"+date.getDay()+" "+date.getHours()+":"+date.getMinutes()+":"+date.getSeconds(),
					price: $("#price").val(),
					online: +($("#online ")[0].checked)
				};

				$.ajax({
					type: "POST",
					url: "newappointment.php?action=create",
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