<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Producto no encontrado - <?=APPNAME?></title>
	<link rel="stylesheet" href="<?php echo base_url() ?>stylesheets/css/user_not_found_styles.css">
	<?php include APPPATH . 'views/inc/head.php' ?>
</head>
<body>
	<header>
		<?php include APPPATH . 'views/inc/nav.php' ?>
	</header>

	<main>
		<div class="content">		
			<h2>Producto no encontrado</h2>
			<p>El producto que intentas ver no existe en el sistema</p>
			<a href="<?=site_url()?>">¡Continua Comprando!</a>
		</div>
	</main>

	<!-- Footer -->
 	<?php include APPPATH . "views/inc/footer.php" ?>
</body>
</html>