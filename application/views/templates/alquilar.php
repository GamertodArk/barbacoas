<!DOCTYPE html>
<html lang="es">
<head>
	<meta charset="UTF-8">
	<title>Concretar la compra</title>
	<link rel="stylesheet" href="<?=base_url('stylesheets/css/')?>alquiler_styles.css">
	<?php include APPPATH . 'views/inc/head.php'; ?>
</head>
<body>
	<header>
		<?php include APPPATH . 'views/inc/nav.php'; ?>
	</header>

	<main>
		<div class="wrap">
			<ul>
				<?php
					foreach ($products as $product) {
						echo "<li> " . $product['title'] . " - ". $product['price'] ."$ x " . $product['amount'] . " durante " . $product['time']['time_lapse_amount'] . " " . $product['time']['time_lapse'];
					}
				?>
			</ul>
			<p class="total">Total: <?=$total_price?>$</p>
			<div class="buttons">
				<a class="cancel" href="#">Cancelar</a>
				<a class="buy" href="#">Pagar</a>
			</div>
		</div>
	</main>

	<?php include APPPATH . 'views/inc/footer.php'; ?>
</body>
</html>
