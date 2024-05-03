<div class="container margin-tb-5rem">
	<div class="row justify-content-center mt-5">
		<div class="col-md-6">
			<div class="card">
				<div class="card-header text-center">
					<h5>Giriş Yap</h5>
				</div>
				<div class="card-body">
					<form action="login.php?action=login" method="POST">
						<div class="form-group">
							<label for="email">E-posta Adresi:</label>
							<input type="email" class="form-control" id="email" name="email" required>
						</div>
						<div class="form-group">
							<label for="password">Şifre:</label>
							<input type="password" class="form-control" id="password" name="password" required>
						</div>

						<?php
						//Mesaj bölümü 
							if (isset($msg)) {
								echo '<div class="alert ';
								echo $msg["type"];
								echo '" role="alert">';
								echo $msg["text"];
								echo '</div>';

								echo '<script>history.pushState({}, "", "login.php");</script>';
							}else{
								echo "<br>";
							}
						?>
						<button type="submit" class="btn btn-primary btn-block w-100">Giriş Yap</button>
						<br>			
					</form>
				</div>
			</div>
		</div>
	</div>
</div>