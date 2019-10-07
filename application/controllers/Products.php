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

		private function add_to_basket($id)
		{
			if (in_array($id, $_SESSION['products'])) {
				return false;
			}else {
				array_push($_SESSION['products'], $id);
				return true;
			}
		}

		function add_product_to_basket($id)
		{
			try{
				if ($this->session->logged_in) {

					if ($this->add_to_basket($id)) {
						$json = ['error' => false, 'code' => 2];
					}else {
						$json = ['error' => false, 'code' => 3];
					}

					echo json_encode($json);						

				}else {
					$json = ['error' => 'true', 'code' => 0];
					echo json_encode($json);
				}
			}catch (Exception $e) {
					$json = ['error' => 'true', 'code' => 1, 'error_msg' => $e->getMessage()];
					echo json_encode($json);				
			}
		}
	}
?>