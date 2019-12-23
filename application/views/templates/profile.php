<!DOCTYPE html>
<html lang="es">
<head>
	<meta charset="UTF-8">
	<title><?=$user_data['name']?> - <?=APPNAME?></title>
	<link rel="stylesheet" href="<?php echo base_url('stylesheets/css/') ?>profile_styles.css">
	<?php include APPPATH . 'views/inc/head.php' ?>
</head>
<body>
	<header>
		<?php include APPPATH . 'views/inc/nav.php' ?>
	</header>

	<main>
		<div class="user_summary">
			<div class="content">
				<!-- <div class="img"></div> -->
				<img src="<?=base_url('img/users/' . $user_data['profile_img'])?>" alt="">
				<h3><?php echo $user_data['name'] . " " . $user_data['lastname']; ?></h3>
				<h4>@<?=$user_data['username']?></h4>
			</div>
		</div>

		<div class="products">
			<h2>Productos Publicados</h2>

			<div class="products_wrap">
				<?php if($product_data): ?>
					<?php foreach ($product_data as $product): ?>
						<div class="item_list">
							<div class="cover_img">
								<?php $image = explode(';', $product['images'])[0]; ?>
								<img src="<?php echo base_url('img/products/') . $image?>" alt="">
							</div>
							<div class="description">
								<!-- <p><?= $product['description']?></p> -->
								<a href="<?php echo site_url('products/review/') . $product['id'] ?>"><?= $product['description']?></a>
							</div>
							<div class="options">
								<span class="count"><?= $product['amount']?></span>
							</div>
						</div>
					<?php endforeach; ?>

				<?php else: ?>
					<p>No tiene productos actualmente</p>
				<?php endif; ?>
			</div>
		</div>

		<!-- <hr> -->

		<!-- <h2>Nojoda</h2> -->
	</main>

	<?php include APPPATH . 'views/inc/footer.php' ?>
</body>
</html>