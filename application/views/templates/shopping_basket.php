<!DOCTYPE html>
<html lang="es">
<head>
	<meta charset="UTF-8">
	<title>Cesta de compra - <?=APPNAME?></title>
	<link rel="stylesheet" href="<?php echo base_url() ?>stylesheets/css/shopping_basket.css">
	<?php include APPPATH . 'views/inc/head.php' ?>
</head>
<body>
	<header>
		<?php include APPPATH . 'views/inc/nav.php' ?>
	</header>

	<main>
		<div class="wrapper">
			<h1>Carrito de compras</h1>

			<div class="products_wrap">
				<h2>Productos</h2>

				<div class="items-wrap">
					<?php foreach ($_SESSION['products'] as $product ): ?>
						<div class="product">
							<div class="left">
								<div class="img">
									<img src="<?=base_url() . 'img/products/' . $product['thumnail']?>" alt="">
								</div>

								<h3><?=$product['title']?></h3>
							</div>
							<div class="right">
								<span class="amount"><?=$product['amount']?></span>
								<span onclick="delete_from_basket(<?=$product['id']?>, this.parentNode.parentNode, true)" class="trash-icon">
									<i class="far fa-trash-alt"></i>
								</span>
							</div>
						</div>
					<?php endforeach; ?>

				</div>
			</div>
		</div>

		<aside class="sidebar">
			<div class="widget-1">
				<h2>Tu widget aqui</h2>
				<p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Dolore, alias?</p>
				<h3>Lorem ipsum dolor.</h3>
			</div>

			<div class="rent">
				<h2>Contactar a los dueños</h2>
				<p>Su carrito contiene 10 articulo(s)</p>
				<a href="#">Alquilar</a>
			</div>
		</aside>
	</main>

 	<?php include APPPATH . "views/inc/footer.php" ?>
</body>
</html>