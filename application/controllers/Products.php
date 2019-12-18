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

		function summary($id)
		{
			echo $id;
		}

		function get_product_data($id)
		{
			$id = intval($id);
			$product_data = $this->products_model->get_product_data($id);
			$product_data['images'] = explode(';', $product_data['images']);
			echo json_encode($product_data);
		}

		private function add_to_basket($data)
		{
			
			if (array_key_exists($data->id, $_SESSION['products'])) {
				return false;
			}else {
				$basketData = $this->products_model->get_product_data($data->id);

				$_SESSION['products'][$data->id] = [
					'id' => $data->id,
					'amount' => $data->amount,
					'title' =>  $basketData['title'],
					'thumnail' => explode(';', $basketData['images'])[0]
				];

				return true;
			}
		}

		function add_product_to_basket($id)
		{
			$data = json_decode($this->input->post('data'));
			
			try{
				if ($this->session->logged_in) {

					if ($this->add_to_basket($data)) {
	
						$json = [
							'error' => false, 
							'code' => 2,
							'product_id' => $_SESSION['products'][$id]['id'],
							'product_title' => $_SESSION['products'][$id]['title'],
							'thumnail_title' => $_SESSION['products'][$id]['thumnail']
						];

					}else {
						$json = ['error' => false, 'code' => 3];
					}

					echo json_encode($json);
					// var_dump($_SESSION['products']);
				}else {
					$json = ['error' => 'true', 'code' => 0];
					echo json_encode($json);
				}
			}catch (Exception $e) {
					$json = ['error' => 'true', 'code' => 1, 'error_msg' => $e->getMessage()];
					echo json_encode($json);				
			}
		}

		function delete_from_basket($id)
		{
			unset($_SESSION['products'][$id]);
			echo $id;
		}
	}
?>