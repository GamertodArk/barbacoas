
<div id="modal-background">
	<div class="info-wrap">

		<div id="loading-wrap" class="loading-wrap">
			<div class="loading"></div>
		</div>

		<div class="item-details">
			 <span id="close_btn">
				<i class="fas fa-times"></i>
			</span>

			<div id="product_modal_left_data" class="left">
				<!-- <?php include APPPATH . 'views/inc/product_preview_gallery.php' ?> -->
			</div>

			<div class="right">
				<h2 id="product_title"></h2> <!--Title-->

				<div class="description">
					<h3>Descripcion</h3>
					<p id="product_desc"></p> <!-- Description -->
				</div>

				<!-- <div class="pricing">
					<p>Precio:</p>
					<p class="price">23 $</p>
					<strong>|</strong>
					<p>Dia</p>
				</div> -->

				<!-- <div class="days_amount">
					<p>Dias:</p>

					<span class="amount_wrapper">
						<span id="increase_days_model" class="more">
							<i class="fas fa-plus"></i>
						</span>

						<input type="text" class="days" name="days" id="amount_days_model" value="1" placeholder="1">

						<span id="decrease_days_model" class="less">
							<i class="fas fa-minus"></i>
						</span>
					</span>

				</div> -->

				<div role="form" class="time-wrap">

					<select id="time-lapse-m" class="time-lapse" name="time-lapse">
						<option value="days">Dias</option>
						<option value="weeks">Semanas</option>
						<option value="months">Meses</option>
					</select>

					<input type="text" id="time-lapse-amount-m" name="amount" value="1" placeholder="1">
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

				<span class="seller">Vendedor: <a href="#" id="product_modal_seller_link"></a></span>

				<button id="add_cesta_btn" class="cesta_btn">AÑADIR A LA CESTA</button>

				<!-- Error structure -->
				<?php include APPPATH . 'views/inc/product_info_error_structure.php' ?>
			</div>
		</div>
	</div>
</div>
<script src="<?php echo base_url(); ?>js/product_modal_wrap.js"></script>
