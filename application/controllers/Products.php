<?php  
	class Products extends CI_Controller {
		function __construct()
		{
			parent::__construct();
			$this->load->model('products_model');

			// Only accept post requests
			if (! $_POST) {
				echo '<h1>Esta pagina esta prohibida para usuarios</h1>';
				echo '<a href="#">Ir al inicio</a>';
				exit();
			}
		}

		function get_product_data($id)
		{
			$id = intval($id);
			$product_data = $this->products_model->get_product_data($id);
			$product_data['images'] = explode(';', $product_data['images']);
			echo json_encode($product_data);
		}
	}
?>