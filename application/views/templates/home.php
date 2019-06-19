<!DOCTYPE html>
<html lang="es">
<head>
	<meta charset="UTF-8">
	<title><?php echo APPNAME; ?></title>
	<link rel="stylesheet" href="<?php echo base_url() ?>stylesheets/css/all.css">
	<link rel="stylesheet" href="<?php echo base_url() ?>stylesheets/css/home_styles.css">
</head>
<body>
	<header>
		<nav>
			<div class="nav-content">			
				<div class="logo">
					<a href="#">Barbacoas</a>
				</div>

				<ul class="links">
					<li><a href="#">Link #1</a></li>
					<li><a href="#">Link #2</a></li>
					<li><a href="#">Link #3</a></li>
				</ul>

				<ul class="users">
					<li title="Iniciar Session"><a href="#">
						<i class="fas fa-sign-in-alt"></i>
					</a></li>
					<li title="Registrarse"><a href="#">
						<i class="fas fa-user-plus"></i>
					</a></li>
				</ul>
			</div>
		</nav>
		<div class="header-overlay"></div>
		<div class="header-content">
			<h2>Lorem ipsum dolor sit.</h2>
			<p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Dolores repellendus eos impedit modi harum ratione ullam et tenetur dolore doloribus ex, sit culpa repudiandae nemo unde debitis obcaecati labore, quo!</p>
		</div>
	</header>

	<main>
		<div class="main-content">
			<h2>Lorem ipsum dolor.</h2>
			<hr>

			<div class="item-wrap">
				<div class="item">
					<div class="img"></div>	
					<div class="item-content">
						<h3>Lorem ipsum dolor sit.</h3>
					</div>
				</div>
			</div>
		</div>
	</main>

	<footer>
		<div class="footer-content">
			<h2><?php echo APPNAME; ?></h2>
			<p>En <?php echo APPNAME; ?> somos buenos porque Lorem ipsum dolor sit amet, consectetur adipisicing elit. Minima quos repellendus eveniet esse, omnis nesciunt facilis alias magni dolorem. Praesentium eum blanditiis, rem nam tenetur rerum soluta consectetur quo mollitia.</p>

			<ul class="social-media">
				<li><a href="#">
					<i class="fab fa-facebook-f"></i>
				</a></li>
				<li><a href="#">
					<i class="fab fa-instagram"></i>
				</a></li>
			</ul>
		</div>
	</footer>
</body>
</html>