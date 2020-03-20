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
				<div class="title">
					<h2>Productos</h2>
					<ul>
						<li>Dias</li>
						<li>Cantidad</li>
					</ul>
				</div>

				<div class="items-wrap">
					<?php if($products_basket_amount > 0): ?>
						<?php foreach ($_SESSION['products'] as $product ): ?>
							<div class="product">
								<div class="left">
									<div class="img">
										<img src="<?=base_url() . 'img/products/' . $product['thumnail']?>" alt="">
									</div>

									<!-- <h3><?=$product['title']?></h3> -->
									<a href="<?php echo site_url("products/review/") . $product['id'] ?>"><?=$product['title']?></a>
								</div>
								<div class="right">
									<span class="time_lapse">Durante <strong><?php echo $product['time']['time_lapse_amount'] . ' ' . $product['time']['time_lapse'] ?></strong>	</span>
									<!-- <span class="amount"><?=$product['time']['time_lapse']?></span>
									<span class="amount"><?=$product['time']['time_lapse_amount']?></span> -->


									<span class="amount"><?=$product['amount']?></span>
									<span onclick="delete_from_basket(<?=$product['id']?>, this.parentNode.parentNode, true)" class="trash-icon">
										<i class="far fa-trash-alt"></i>
									</span>
								</div>
							</div>
						<?php endforeach; ?>
					<?php else: ?>
						<h3 class="empty">No tienes productos en la cesta</h3>
					<?php endif; ?>

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
				<p>Su carrito contiene <?=$products_basket_amount?> articulo(s)</p>
				<a href="<?=site_url('members/alquilar')?>">Alquilar</a>
			</div>
		</aside>
	</main>

 	<?php include APPPATH . "views/inc/footer.php" ?>
</body>
</html>
