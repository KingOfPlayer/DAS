<?php
	include("../templates/navgenerate.php");

	function getImg($imguid,$gender){
	if($imguid == NULL){
		if($gender == 'E'){
			return "/img/m.png";
		}else{
			return "/img/f.png";
		}
	}else{
		return "/doctor/profile-imgs/$imguid";
	}
}

	if (session_status() == PHP_SESSION_NONE) {
		session_start();
	}

    if(isset($_SESSION[$session_text])) {
		
		include("../database.php");

		$nav_sql="SELECT * FROM das.doctors WHERE email = '".$_SESSION[$session_text]."'";
		$nav_result=$database->query($nav_sql);
        $nav_row = $nav_result->fetch_assoc();

		addLogoToNav("index.php");
		addToNAV("
			<div class=\"main-menu\">
				<nav class=\"navigation\">
					<ul class=\"nav menu\">
						<li><a href=\"#\">Randevu <i class=\"icofont-rounded-down\"></i></a>
							<ul class=\"dropdown\">
								<li><a href=\"./appointments.php\">Aktif Randevularım</a></li>
								<li><a href=\"./newappointment.php\">Yeni Randevu</a></li>
							</ul>
						</li>
					</ul>
				</nav>
			</div>
		");
		
		addToNAV("
			<div class=\"col-lg-2 col-12\">
				<nav class=\"navigation\">
					<ul class=\"nav menu\">
							<li class=\"justify-content-center d-flex\" style=\" max-width: 2.5rem;max-height: 2.5rem;\">
								<img src=\"".getImg($nav_row['imguid'],$nav_row['gender'])."\" class=\"card-img-top rounded w-au\" alt=\"" . $nav_row['name'] . " " . $nav_row['surname'] . "\">
							</li>
						<li><a href=\".\index.php\" class=\"btn btn-primary btn-block text-light\">".$nav_row["name"]. " ".$nav_row["surname"]."</a>
							<ul class=\"dropdown\">
								<li><a href=\"./profile.php\">Profil Resimi yükle</a></li>
								<li><a href=\"./login.php?action=logout\">Çıkış Yap</a></li>
							</ul>
						</li>
					</ul>
				</nav>
			</div>
		");
    }else{
		addLogoToNav("/index.php");
		$splited_url = explode("/",$_SERVER['REQUEST_URI']);
		$file_name = end($splited_url);

		if($file_name == "newaccount.php"){
			addToNAV("
				<div class=\"col-lg-2 col-12\">
					<a href=\".\login.php\" class=\"btn btn-primary btn-block text-light\">Giriş Yap</a>
				</div>
			");
		}
	}
			
	printNav();