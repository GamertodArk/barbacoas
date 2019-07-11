<nav>
	<div class="nav-content">			
		<div class="logo">
			<a href="<?php echo base_url('home') ?>">Barbacoas</a>
		</div>

		<?php if(isset($username)): ?>
			<div class="search">
				<form action="#">	
					<input type="text" name="search" id="search" placeholder="Buscar">
					<button role="submit"><i class="fas fa-search"></i></button>
				</form>
			</div>		
		<?php else: ?>
			<ul class="links">
				<li><a href="<?php echo base_url('home') ?>">Inicio</a></li>
				<li><a href="#">Link #2</a></li>
				<li><a href="#">Link #3</a></li>
			</ul>
		<?php endif; ?>
	



		<?php if(isset($username)): ?>
			<ul class="user username">
				<li>
					<?=$username?>
					<ul class="children">
						<div class="triangle"></div>
						<li><a href="#">Perfil</a></li>
						<li><a href="#">Lorem ipsum dolor.</a></li>
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
