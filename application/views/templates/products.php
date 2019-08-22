<!DOCTYPE html>
<html lang="es">
<head>
	<meta charset="UTF-8">
	<title>Mis Barbacoas  - <?=APPNAME?></title>
	<link rel="stylesheet" href="<?php echo base_url('stylesheets/css/')?>myProducts_styles.css">
	<?php include APPPATH . 'views/inc/head.php' ?>
</head>
<body>
	<header>
		<?php include APPPATH . 'views/inc/nav.php' ?>
	</header>

	<main>
		<div class="wrapper">
			<?php if($this->session->flashdata('success')): ?>
				<div class="success-message">
					<h3>Producto Añadido satisfactoriamente</h3>

					<span onclick="this.parentNode.parentNode.removeChild(this.parentNode)" id="close_btn">
						<i class="fas fa-times"></i>
					</span>
				</div>
			<?php endif; ?>

			<div class="title">
				<h2>Mis Barbacoas</h2>

				<a href="<?php echo base_url('members/add_products') ?>">Añadir Producto</a>
			</div>
			
			<?php if(true): ?>

				<div class="barbacoas_wrapper">
					<?php for($i = 0; $i < 11; $i++): ?>
						<?php include APPPATH . 'views/inc/item.php'; ?>
					<?php endfor; ?>
				</div>


			<?php else: ?>
				<div class="barbacoas_wrapper none">
					<p>No tienes Barbacoas actualmente</p>
				</div>
			<?php endif; ?>
		</div>
	</main>

	<?php include APPPATH . 'views/inc/footer.php' ?>
</body>
</html>