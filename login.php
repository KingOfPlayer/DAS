<?php
session_start();

if(isset($_SESSION['email'])) {
    // Kullanıcı zaten oturum açmışsa ana sayfaya yönlendir
    header("Location: index.php");
    exit;
}

// Formdan veri gönderildiğinde
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // E-posta ve şifre al
    $email = $_POST['email'];
    $password = $_POST['password'];

    // Veritabanı bağlantısını yapın
    // Örnek olarak, MySQL kullanarak bir bağlantı yapalım
    $servername = "localhost";
    $username = "root";
    $password_db = "";
    $dbname = "doktorlar";

    // Bağlantı oluştur
    $conn = new mysqli($servername, $username, $password_db, $dbname);

    // Bağlantıyı kontrol et
    if ($conn->connect_error) {
        die("Bağlantı hatası: " . $conn->connect_error);
    }

    // Veritabanında kullanıcıyı sorgula
    $sql = "SELECT * FROM doktorlar WHERE email = '$email' AND password = '$password'";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        // Oturumu başlat
        $_SESSION['email'] = $email;

        // Oturum başarılı, ana sayfaya yönlendir
        header("Location: index.php");
        exit;
    } else {
        // Kullanıcı adı veya şifre yanlış, hata mesajı göster
      // Kullanıcı adı veya şifre yanlış, hata mesajı göster
      $_SESSION['error_message'] = "E-posta veya şifre hatalı.";
        
      // Giriş sayfasına geri yönlendir
      header("Location: giriş1.php");
      
    }

    $conn->close();
}
?>
