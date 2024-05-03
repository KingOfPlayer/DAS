<?php

include("../database.php");

// Şehirleri veritabanından al
$sql = "SELECT * FROM city";
$sql1= "select * from doctor_specialty";
$result = $database->query($sql);
$result1 = $database->query($sql1)
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
        <div class="container margin-5rem">
            <div class="row justify-content-center mt-5">
                <div class="col-md-6">
                    <form action="submit.php" method="post">
                        <div class="form-row align-items-center">
                            <div style="width: 200px; height: 200px; overflow: overlay;" class="col">
                                <label for="sehir" style="margin-bottom: 10px;">Şehir Seçin:</label>
                                <select class="form-control" id="sehir" name="sehir">
                                    <?php
                                    if ($result->num_rows > 0) {
                                        while($row = $result->fetch_assoc()) {
                                            echo "<option value='" . $row['id'] . "'>" . $row['name'] . "</option>";
                                        }
                                    } else {
                                        echo "<option value='-1'>Veri bulunamadı</option>";
                                    }
                                    ?>
                                </select>
                            </div>
                            <div style="width: 200px; height: 200px; overflow: overlay;" class="col">
                                <label for="doctor_specialty">uzmanlık:</label>
                                <select  class="form-control" id="doctor_specialty" name="doctor_specialty">
                                    <?php
                                    if ($result1->num_rows > 0) {
                                        while($row = $result1->fetch_assoc()) {
                                            echo "<option value='" . $row['id'] . "'>" . $row['name'] . "</option>";
                                        }
                                    } else {
                                        echo "<option value='-1'>Veri bulunamadı</option>";
                                    }
                                    ?>
                                </select>
                            </div>
                        </div>
                        <div class="form-group text-center">
                            <button type="submit" class="btn btn-primary mt-3">Gönder</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>

		<?php
			include("../templates/importfooter.php");
			include("../templates/importjs.php");
		?>
    </body>
</html>
