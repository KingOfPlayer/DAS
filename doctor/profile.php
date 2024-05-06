<?php
// Eğer dosya doktor,hasta,admindeyse bunu ekle
$session_text = "d_email";
include("../templates/logincheck.php");

	include("../database.php");

	function boolToElement($bool,$true_element,$false_element){
		if($bool==1){
			return $true_element;
		}else{
			return $false_element;
		}
	}
	
	$sql = "SELECT * FROM das.doctors WHERE email = '".$_SESSION[$session_text]."'";
	$doctor = $database->query($sql);
	$row = $doctor->fetch_assoc();

	if (isset($_GET['action']) && $_GET['action'] == "photo") {
		$uuid = uniqid();
		$msgtostore = 1;
		echo var_dump($_FILES);
		include("./profile-imgs/uuidimg.php");
		$sql="UPDATE `das`.`doctors` SET `imguid` = '$file_name' WHERE (`id` = '".$row['id']."')";
		$doctor = $database->query($sql);
        header("Location: index.php");
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
		    <div class="my-5 p-5">
				<div class="card">
					<div class="card-header text-center">
						<h5>
							Profil Resimini Güncelle
						</h5>
					</div>
					<div class="card-body justify-content-center">
						<div class="col-5 d-flex justify-content-center pe-5 pt-3">
						</div>
						<form action="profile.php?action=photo" method="POST" enctype="multipart/form-data">
						
							<?php
								echo "<div class=\"justify-content-center d-flex\">
									<img src=\"".getImg($row['imguid'],$row['gender'])."\" class=\"card-img-top rounded w-au w-25\" alt=\"" . $row['name'] . " " . $row['surname'] . "\">
								</div>";	
							?>
							<div class="mb-3">
								  <label for="profilephoto" class="form-label">Resim :</label>
								  <input class="form-control" type="file" accept="image/*" name="profilephoto" id="profilephoto">
							</div>
							<div class="row">
								<button type="submit" class="pb-3 mx-3 btn btn-primary btn-block w-100">Resimi Yükle</button>
							</div>
							
						</form>
					</div>
				</div>
		    </div>
		</div>


		<?php
			include("../templates/importfooter.php");
			include("../templates/importjs.php");
		?>
    </body>
</html>