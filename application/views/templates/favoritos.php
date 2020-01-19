<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Favoritos - <?=APPNAME?></title>
	<link rel="stylesheet" href="<?php echo base_url('stylesheets/css/')?>favoritos.css">
	<?php include APPPATH . 'views/inc/head.php'; ?>
</head>
<body>
	<header>
		<?php include APPPATH . 'views/inc/nav.php'; ?>
	</header>

	<main>
		<h2>Mis favoritos</h2>

		<div class="wrapper">
			<?php if($favorites): ?>

				<?php $products = $favorites; // rename variable so the forEach lopp could word?>
				<?php include APPPATH . 'views/inc/item.php'; ?>

				<!--
				<?php foreach($favorites as $product): ?>
				<div data-product-id="20" class="item">
					<span id="item_view" class="view view_item_btn"><i class="far fa-eye"></i></span>

					<div class="image-wrap">
						<img src="<?php echo base_url() ?>img/products/pic_14_big.jpg" alt="">
					</div>
					<div class="item-content">
						<a href="">php</a>
					</div>
				</div>
				<?php endforeach; ?>
				-->
			<?php else: ?>
				<div class="empty">			
					<h3>No tienes productos en tu lista de favoritos</h3>
					<a href="#">Encuentra productos</a>
				</div>
			<?php endif; ?>
		</div>
	</main>

	<?php include APPPATH . 'views/inc/footer.php'; ?>
	<?php include APPPATH . 'views/inc/product_modal.php'; ?>
</body>
</html>