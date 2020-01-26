<nav>
	<div class="nav-content">			
		<div class="logo">
			<a href="<?php echo base_url('home') ?>">Barbacoas</a>
		</div>

		<?php if(isset($session_data['username'])): ?>
			<div class="search">
				<form action="<?=base_url('search')?>" method="get">	
					<input type="text" name="search" id="search" placeholder="Buscar">
					<button role="submit"><i class="fas fa-search"></i></button>
				</form>
			</div>		
		<?php else: ?>
			<ul class="links">
				<li><a href="<?php echo base_url('home') ?>">Inicio</a></li>
				<li><a href="<?php echo base_url('search') ?>">Buscar</a></li>
				<li><a href="#">Link #3</a></li>
			</ul>
		<?php endif; ?>
	

		<?php if(isset($session_data['username'])): ?>
			<ul class="user username">
				<?php include 'shoping_basket_nav.php'; ?>

				<li id="user_btn" class="user_btn">
					<?=$session_data['username']?>
					<ul id="user_btn_children" class="children">
						<div class="triangle"></div>
						<li><a href="<?php echo site_url('perfil/') ?>">Perfil</a></li>
						<li><a href="<?php echo site_url('favoritos/') ?>">Favoritos</a></li>
						<li><a href="<?php echo site_url('search/') ?>">Buscar</a></li>
						<li><a href="<?php echo site_url('members/products') ?>">Mis Barbacoas</a></li>
						<li><a href="<?php echo site_url('members/shopping_basket') ?>">Ver la cesta de compra</a></li>
						<li><a href="<?php echo site_url('logout') ?>">Cerrar Session</a></li>
					</ul>
				</li>
			</ul>
		<?php else: ?>
			<ul class="users">
				<li title="Iniciar Session"><a href="<?php echo base_url('users/login') ?>">
					<i class="fas fa-sign-in-alt"></i>
				</a></li>
				<li title="Registrarse"><a href="<?php echo base_url('users/signup') ?>">
					<i class="fas fa-user-plus"></i>
				</a></li>				
			</ul>
		<?php endif; ?>


	</div>
</nav>
