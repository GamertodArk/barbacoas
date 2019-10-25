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
			if (/*in_array($id, $_SESSION['products'])*/ array_key_exists($id, $_SESSION['products'])) {
				return false;
			}else {
				$basketData = $this->products_model->get_product_data($id);
				// $basketDataStructure = [$id => [
				// 	'id' => $id,
				// 	'title' =>  $basketData['title']					
				// ]];
				// array_push($_SESSION['products'], $basketDataStructure);

				// $_SESSION['products'][] = 

				$_SESSION['products'][$id] = [
					'id' => $id,
					'title' =>  $basketData['title']
				];
				return true;
			}
		}

		function add_product_to_basket($id)
		{
			try{
				if ($this->session->logged_in) {

					if ($this->add_to_basket($id)) {
		
						// echo $_SESSION['products'][$id];
						// var_dump($_SESSION['products']);
						// exit();

						// $proData = $this->products_model->get_product_data($id);
						$json = [
							'error' => false, 
							'code' => 2,
							'product_id' => $_SESSION['products'][$id]['id'],
							'product_title' => $_SESSION['products'][$id]['title']
						];

						// $json = 'testing';

					}else {
						$json = ['error' => false, 'code' => 3];
					}

					echo json_encode($json);
					// echo array_key_exists(10, $_SESSION['products']) ? 'true' : 'false';
					// var_dump($json);


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