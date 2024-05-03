<?php

    //Veritabanı Bilgisi
    $servername = "localhost";
    $username = "root";
    $password_db = "1234";
    $dbname = "DAS";

    //Veritabını Değişkeni
    $database = new mysqli($servername, $username, $password_db, $dbname);

    
    //Veritabanı Bağlantısı Kontrolü
    if ($database->connect_error) {
        die("Bağlantı hatası: " . $database->connect_error);
    }
?>