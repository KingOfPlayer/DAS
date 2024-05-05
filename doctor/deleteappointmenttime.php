<?php
// Eğer dosya doktor,hasta,admindeyse bunu ekle
$session_text = "d_email";
include("../templates/logincheck.php");

include("../database.php");
$sql = "DELETE FROM `das`.`appointment_times` 
WHERE
    (`id` = ". $_GET['id'] ."
    AND (SELECT 
        das.doctors.id AS doctorid
    FROM
        das.doctors
    WHERE
        das.doctors.email = '". $_SESSION[$session_text]."') = doctor_id)";
$return = $database->query($sql);

header("Location: ./activeappointmentstimes.php'");

?>