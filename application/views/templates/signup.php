<!DOCTYPE html>
<html lang="es">
<head>
	<meta charset="UTF-8">
	<title><?php echo APPNAME ?></title>
	<link rel="stylesheet" href="<?php echo base_url(); ?>stylesheets/css/all.css">
	<link rel="stylesheet" href="<?php echo base_url(); ?>stylesheets/css/signup_styles.css">
</head>
<body>
	<header>
		<!-- Nav -->
		<?php include APPPATH . 'views/inc/nav.php' ?>
	</header>

	<main>
		<h2>Registrarse en <?php echo APPNAME ?></h2>

		<form action="#">
			<div class="fullname">
				<div class="name">
					<input type="text" name="name" id="name" placeholder="Nombre">
				</div>

				<div class="lastname">
					<input type="text" name="lastname" id="lastname" placeholder="Apellido">
				</div>
			</div>

			<input type="text" name="username" id="username" placeholder="Username">

			<input type="email" name="email" id="email" placeholder="Email">

			<div class="location">
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

			<input type="password" name="pass" id="pass" placeholder="Contraseña">

			<input type="password" name="pass2" id="pass2" placeholder="Repetir Contraseña">

			<input type="submit" value="Registrarse">
		</form>
	</main>
	
	<!-- Footer -->
 	<?php include APPPATH . "views/inc/footer.php" ?>
	<script src="//ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script> 
	<script src="//geodata.solutions/includes/countrystatecity.js"></script>
</body>
</html>