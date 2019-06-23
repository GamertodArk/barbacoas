<!DOCTYPE html>
<html lang="es">
<head>
	<meta charset="UTF-8">
	<title><?php echo APPNAME ?></title>
	<link rel="stylesheet" href="<?php echo base_url(); ?>stylesheets/css/all.css">
	<link rel="stylesheet" href="<?php echo base_url(); ?>stylesheets/css/signup_styles.css">
</head>
<body>
	<!-- loading modal -->
	<div id="loading-modal-wrap" class="loading-modal-wrap">
		<div class="loading-modal"></div>
	</div>
	<header>
		<!-- Nav -->
		<?php include APPPATH . 'views/inc/nav.php' ?>
	</header>

	<main>
		<h2>Registrarse en <?php echo APPNAME ?></h2>

		<form action="#">
			<div class="fullname">
				<div class="name">
					<span id="name-error">Lorem ipsum dolor.</span>
					<input type="text" name="name" id="name" placeholder="Nombre">
				</div>

				<div class="lastname">
					<span id="lastname-error">Lorem ipsum dolor.</span>
					<input type="text" name="lastname" id="lastname" placeholder="Apellido">
				</div>
			</div>

			<div class="username">
				<span id="username-error">Lorem ipsum dolor.</span>
				<input type="text" name="username" id="username" placeholder="Username">
			</div>

			<div class="email">
				<span id="email-error">Lorem ipsum dolor.</span>
				<input type="email" name="email" id="email" placeholder="Email">
			</div>

			<div class="location">
				<span id="location-error">Lorem ipsum dolor.</span>

				<div class="location-content">
					<select name="country" class="countries" id="countryId">
					    <option value="">Selecionar Pais</option>
					</select>
					<select name="state" class="states" id="stateId">
					    <option value="">Selecionar Estado</option>
					</select>
					<select name="city" class="cities" id="cityId">
					    <option value="">Selecionar Ciudad</option>
					</select>
				</div>			
			</div>

			<div class="pass">
				<span id="pass-error">Lorem ipsum dolor.</span>
				<input type="password" name="pass" id="pass" placeholder="Contraseña">
			</div>

			<div class="pass2">
				<span id="pass2-error">Lorem ipsum dolor.</span>
				<input type="password" name="pass2" id="pass2" placeholder="Repetir Contraseña">
			</div>

			<input id="sub_btn" type="submit" value="Registrarse">
		</form>
	</main>
	

	<!-- Footer -->
 	<?php include APPPATH . "views/inc/footer.php" ?>
	<script src="//ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script> 
	<script src="//geodata.solutions/includes/countrystatecity.js"></script>
	<script src="<?php echo base_url() ?>js/generals.js"></script>
	<script src="<?php echo base_url() ?>js/signup_scripts.js"></script>
</body>
</html>