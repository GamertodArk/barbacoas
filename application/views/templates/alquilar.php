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
					foreach ($_SESSION['products'] as $product) {
						var_dump($product);
						// echo "<li>$product['title'] - </li>";
					}
				?>
				<!-- <li>Producto 1 - 23$ x 3 durante 10 dias</li> -->
				<!-- <li>Producto 1 - 23$ x 3 durante 10 dias</li> -->
				<!-- <li>Producto 1 - 23$ x 3 durante 10 dias</li> -->
			</ul>
			<p class="total">Total: XXX$</p>
			<div class="buttons">
				<a class="cancel" href="#">Cancelar</a>
				<a class="buy" href="#">Pagar</a>
			</div>
		</div>
	</main>

	<?php include APPPATH . 'views/inc/footer.php'; ?>
</body>
</html>