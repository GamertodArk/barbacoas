<!DOCTYPE html>
<html lang="es">
<head>
	<meta charset="UTF-8">
	<title><?php echo APPNAME; ?></title>
	<link rel="stylesheet" href="<?php echo base_url() ?>stylesheets/css/home_styles.css">
	<?php include APPPATH . 'views/inc/head.php' ?>
</head>
<body>
	<header>
		<?php include APPPATH . 'views/inc/nav.php' ?>
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
			<?php for($i = 0; $i < 11; $i++): ?>
				<?php include APPPATH . 'views/inc/item.php'; ?>
 			<?php endfor; ?>
			</div>
		</div>
	</main>
 	<?php include APPPATH . "views/inc/footer.php" ?>
 	<?php include APPPATH . "views/inc/product_modal.php" ?> 
	</body>
</html>