<?php
function printLogin($login_type,$header_text = null){
	global $msg;
	if($login_type == "Admin"){
		$header_text = "Giriş Yap";
	}
	$login_page_start = "
		<div class=\"container margin-tb-5rem\">
			<div class=\"row justify-content-center mt-5\">
				<div class=\"col-md-6\">
					<div class=\"card\">
						<div class=\"card-header text-center\">
							<h5>
								$header_text
							</h5>
						</div>
						<div class=\"card-body\">
							<form action=\"login.php?action=login\" method=\"POST\">
								<div class=\"form-group mb-3\">
									<label for=\"email\">E-posta Adresi</label>
									<input type=\"email\" class=\"form-control\" id=\"email\" name=\"email\" required>
								</div>
								<div class=\"form-group mb-3\">
									<label for=\"password\">Şifre</label>
									<input type=\"password\" class=\"form-control\" id=\"password\" name=\"password\" required>
								</div>
	";
	if($login_type == "Admin"){
		$login_page_end = "
									<button type=\"submit\" class=\"mb-3 btn btn-primary btn-block w-100\">Giriş Yap</button>
								</form>
							</div>
						</div>
					</div>
				</div>
			</div>
		";
	}else{
		$login_page_end = "
									<button type=\"submit\" class=\"mb-3 btn btn-primary btn-block w-100\">Giriş Yap</button>
									<div class=\"form-group d-flex d-flex justify-content-center\">
										<a href=\"newaccount.php\" class=\"px-5 link-primary link-offset-2 link-underline-opacity-25 link-underline-opacity-100-hover\">$login_type Hesabınız Yok Mu?</a>
										<a href=\"forgotpassword.php\" class=\"px-5 link-primary link-offset-2 link-underline-opacity-25 link-underline-opacity-100-hover\">Parolamı Unuttum</a>
									</div>
								</form>
							</div>
						</div>
					</div>
				</div>
			</div>
		";
	}
	echo $login_page_start;
	if (isset($msg)) {
		echo '<div class="mb-3 alert ';
		echo $msg["type"];
		echo '" role="alert">';
		echo $msg["text"];
		echo '</div>';

		echo '<script>history.pushState({}, "", "login.php");</script>';
	}
	echo $login_page_end;
}
?>