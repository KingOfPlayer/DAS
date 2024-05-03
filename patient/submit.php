<?php
// Veritabanı bağlantısı
$servername = "localhost";
$username = "root";
$password = "1234";
$dbname = "das";
// Veritabanı bağlantısını oluştur
$conn = new mysqli($servername, $username, $password, $dbname);

// Bağlantıyı kontrol et
if ($conn->connect_error) {
    die("Veritabanı bağlantısı başarısız: " . $conn->connect_error);
}

// Formdan gelen verileri al
$sehir = $_POST['sehir'];
$doctor_specialty = $_POST['doctor_specialty'];

// Doktorları veritabanından al ve uygun olanları filtrele
$sql = "SELECT * FROM das.doctors 
        JOIN das.city ON das.doctors.city_id = das.city.id
        JOIN doctor_specialty ON das.doctors.doctor_specialty_id = doctor_specialty.id
        WHERE das.city.id = $sehir and doctor_specialty.id= $doctor_specialty    ";
$result = $conn->query($sql);

// Sonucu ekrana yazdır
if ($result->num_rows > 0) {
    echo "<div class='container margin-5rem'>";
    echo "<div class='row justify-content-center mt-5'>";
    echo "<div class='col-md-6'>";
    echo "<div class='alert alert-success' role='alert'>Uygun doktorlar bulundu:</div>";
    echo "<div class='doktorlar'>";
    while($row = $result->fetch_assoc()) {
        echo "<p>" . $row['name'] . " " . $row['surname'] . " - " . $row['doctor_specialty'] . "</p>";
    }
    echo "</div>"; // doktorlar divi
    echo "</div>"; // col
    echo "</div>"; // row
    echo "</div>"; // container
} else {
    echo "<div class='container margin-5rem'>";
    echo "<div class='row justify-content-center mt-5'>";
    echo "<div class='col-md-6'>";
    echo "<div class='alert alert-warning' role='alert'>Uygun doktor bulunamadı.</div>";
    echo "$sehir + $doctor_specialty ";
    echo "</div>"; // col
    echo "</div>"; // row
    echo "</div>"; // container
}
echo $sql;

// Veritabanı bağlantısını kapat
$conn->close();
?>