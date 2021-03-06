<?php
	class Products extends CI_Controller {

		private $builder;

		function __construct()
		{
			parent::__construct();
			$this->load->model('products_model');

			// $db      = \Config\Database::connect();
			// $this->builder = $db->table('notifications');

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

			// Product data
			$product_data = $this->products_model->get_product_data($id);
			$product_data['product']['images'] = explode(';', $product_data['product']['images']);
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
					// 'days' => $data->days,
					'title' =>  $basketData['product']['title'],
					'thumnail' => explode(';', $basketData['product']['images'])[0],
					'time' => [
						'time_lapse' => $data->time->time_lapse,
						'time_lapse_amount' => $data->time->time_lapse_amount
					]
				];

				return true;
			}
		}

		function add_product_to_basket($id)
		{

			$data = json_decode($this->input->post('data'));
			// var_dump($data);
			// exit();

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

		// function set_read_notification($id)
		// {
		// 	$id = intval($id);
		// 	$data = ['readed' => 1];
		// 	$this->builder->where('id', $id);
		// 	$this->builder->update($data);
		// 	// $this->db->table('notifications')->where('id', $id)->update($data);
		// 	echo "done";
		// 	// echo 'got here';
		// }
	}
?>
