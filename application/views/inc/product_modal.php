
<div id="modal-background">
	<div class="info-wrap">
		
		<div id="loading-wrap" class="loading-wrap">
			<div class="loading"></div>
		</div>

		<div class="item-details">
			 <span id="close_btn">
				<i class="fas fa-times"></i>
			</span>
			
			<div class="left">
				<?php include APPPATH . 'views/inc/product_preview_gallery.php' ?>
			</div>

			<div class="right">
				<h2 id="product_title">Lorem ipsum dolor.</h2>
				<div class="description">
					<h3>Descripcion</h3>
					<p id="product_desc">Lorem ipsum dolor sit amet, consectetur adipisicing elit. Repellat quibusdam, hic cumque deserunt porro expedita voluptatibus, sed similique sit praesentium.</p>
				</div>	

				<div class="amount">
					<p>Cantidad:</p>

					<span class="amount_wrapper">
						<span id="more_btn" class="more">
							<i class="fas fa-plus"></i>
						</span>

						<input type="text" class="counter" name="counter" id="counter" value="1" placeholder="1">

						<span id="less_btn" class="less">
							<i class="fas fa-minus"></i>
						</span>
					</span>
				</div>

				<button id="add_cesta_btn" class="cesta_btn">AÑADIR A LA CESTA</button>

				<div id="error-msg-wrap">
					<span onclick="this.parentNode.style.display = 'none'" id="close_btn">
						<i class="fas fa-times"></i>
					</span>

					<p id="error-msg">Tienes que iniciar sesion para añadir productos a la cesta de compra</p>
				</div>

			</div>
		</div>
	</div>
</div>
<script src="<?php echo base_url(); ?>js/product_modal_wrap.js"></script>
<!-- <script src="<?=base_url()?>js/glide.js"></script> -->
<script>
	// new Glide('.glide').mount();
</script>