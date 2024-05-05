<?php
$session_text = "p_email";
include("../templates/logincheck.php");
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
        <div class="card">
                
            <div class="card-body">
                <div class="appointment-info">
                    <?php
                    // Veritabanı bağlantısı
                    include ('../database.php');
                    $email=$_SESSION['p_email'];
                    $sql = "SELECT patients.name AS patient_name, appointments.id AS appointment_id, appointments.take_date, appointment_times.date,
            doctors.name AS doctor_name, doctor_specialtys.name AS specialty_name, citys.name AS city_name
    FROM patients
    INNER JOIN appointments ON patients.id = appointments.patients_id
    INNER JOIN appointment_times ON appointments.appointment_times_id = appointment_times.id
    INNER JOIN doctors ON appointment_times.doctor_id = doctors.id
    INNER JOIN doctor_specialtys ON doctors.doctor_specialty_id = doctor_specialtys.id
    INNER JOIN citys ON doctors.city_id = citys.id
    WHERE patients.email = '$email'";
                    $result = $database->query($sql);

                    // Sonucu kontrol et
                    if ($result->num_rows > 0) {
                        // Kayıt bulundu, bilgileri ekrana yazdır
                        while($row = $result->fetch_assoc()) {
                            echo"<h3> randevularım </h3>";
							echo "<p>Hasta ismi: " . $row['patient_name'] . "</p>";
                            echo "<p>Randevu numarası: " . $row['appointment_id'] . "</p>";
                            echo "<p>Randevu tarihi: " . $row['date'] . "</p>";
                            echo "<p>Doktor ismi: " . $row['doctor_name'] . "</p>";
                            echo "<p>Uzmanlık: " . $row['specialty_name'] . "</p>";
                            echo "<p>Şehir: " . $row['city_name'] . "</p>";
                        }
                    } else {
                        // Kayıt bulunamadı
                        echo "<p>Randevu kaydınız bulunamadı.</p>";
                        echo "<div>";
                        echo "<a href='getappointment.php' class='btn'>Randevu Alın </a>";
                        echo " </div>";
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
</body>
</html>
