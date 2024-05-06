<?php
if(isset($msgtostore)){
	$extension = pathinfo($_FILES['profilephoto']['full_path'], PATHINFO_EXTENSION);
	echo $extension;
	move_uploaded_file($_FILES['profilephoto']['tmp_name'], "./profile-imgs/$uuid.$extension");
	$file_name="$uuid.$extension";
}
?>