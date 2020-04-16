<?php
	class Members extends CI_Controller {

		private $data;

		public function __construct()
		{
			parent::__construct();

			$this->load->helper('cookie');
			$this->load->model('users_model');
			$this->load->model('products_model');

			// Check for sessions
			if (! $this->session->logged_in) { redirect('users/login'); }

			// Get information from session and unread notifications
			if ($this->session->logged_in) {
				$this->data = $this->users_model->user_metadata($_SESSION['id']);
			}
		}

		public function set_read_notification($id)
		{
			$this->users_model->set_read_notification($id);
		}

		public function add_to_favorites($id)
		{

			// If the cookie is already initialized, take the new product id
			// and put it together with the other products, else, initialize the cookie with that product
			if ($this->input->cookie('fav_products')) {
				$cookie_value = $this->input->cookie('fav_products') . intval($id) . ';';
			}else {
				$cookie_value = intval($id) . ';';
			}

			// Cookie data
			$cookie = [
				'name' => 'fav_products',
				'value' => $cookie_value,
				'expire' => (time() + (60 * 60 * 24))
			];

			$this->input->set_cookie($cookie);

			// Response to the fetch request
			echo 1;
		}

		public function page($page = NULL)
		{

			// Check if template exists
			if (! file_exists(APPPATH . 'views/templates/' . strtolower($page) . '.php')) {
				show_404();
			}

			// Get products data
			$this->data['products'] = $this->products_model->get_specific_product_data('id, title, images');

			// Get amount of products in the basket
			$this->data['products_basket_amount'] = $this->products_model->get_product_amount_basket();

			// Get favorites products
			$this->data['favorites'] = $this->products_model->get_favorites_proudcts();

			$this->load->view('templates/' . strtolower($page), $this->data);
		}

		public function alquilar()
		{
			$basket_products = [];
			$total_price = 0;

			// Get all userdata from session and pass it to view
			// if ($this->session->logged_in) { $data['session_data'] = $this->users_model->get_userdata(); }

			// Redirect the user if there's no products in the shopping basket
			if ($this->products_model->get_product_amount_basket() <= 0) { redirect('members/shopping_basket'); }

			// Add price to every product
			foreach ($_SESSION['products'] as $product) {
				$price = $this->products_model->get_product_data($product['id'])['product']['price']; // Get price from database
				$product['price'] = $price; // Add the price to rest of the product data
				$basket_products[] = $product;
			}

			// Calculate total price
			foreach ($basket_products as $product) {
				$price = intval($product['price']); // Get the price as String
				$amount = intval($product['amount']); // Get the amount of the same product as a String
				$time_amount = intval($product['time']['time_lapse_amount']); // Get the amount of days/weeks/months as String

				// Getting the amount of days that the product will be rented
				switch ($product['time']['time_lapse']) {
					case 'days':
						$time_lapse = 1;
						break;

					case 'weeks':
						$time_lapse = 7;
						break;

					case 'months':
						$time_lapse = 30;
						break;
				}

				// Calculate the whole cost of a product
				$total_price += $price * $amount * $time_lapse * $time_amount;

			}

			/* Set this the total price as a global data so we can access it in the process payment handler */
			$_SESSION['products_total_price'] = $total_price;

			$this->data['products'] = $basket_products;
			$this->data['total_price'] = $total_price;
			$this->load->view('templates/alquilar', $this->data);
		}

		/*
		* THIS FUNCTION IS INCOMPLETED
		* Right now this whole application does not have a payment handler like Paypal or Payzaa
		* Because of that all this funtion does is get the whole price of everything the user requested
		* and send all the notifications to the products owners.
		*
		* If any payment API is implemented should be here
		*/
		public function process_products_payment()
		{
			// $amount = $_SESSION['products_total_price'];

			// Get all userdata from session and pass it to view
			// if ($this->session->logged_in) { $data['session_data'] = $this->users_model->get_userdata(); }

			// Redirect the user if there's no products in the shopping basket
			if ($this->products_model->get_product_amount_basket() <= 0) { redirect('members/shopping_basket'); }

			// Upload the rentings to the database
			foreach ($_SESSION['products'] as $product) {
				$product_id = $product['id'];
				$user_product_lessee = $_SESSION['id'];
				$products_amount = $product['amount'];
				$time_amount = $product['time']['time_lapse_amount'] . ' ' . $product['time']['time_lapse'];
				$user_product_owner = $this->products_model->get_product_data($product['id'])['seller']['id'];

				$date = date('d/m/Y');
				$date_end = date('d/m/Y', strtotime('+' . $time_amount));

				$data = [
					'date' => $date,
					'date_end' => $date_end,
					'product_id' => $product_id,
					'time_amount' => $time_amount,
					'products_amount' => $products_amount,
					'user_product_owner' => $user_product_owner,
					'user_product_lessee' => $user_product_lessee

				];

				$this->db->insert('rentings', $data);
			}

			// Upload notifications to the database
			foreach ($_SESSION['products'] as $product) {
				$product_id = $product['id'];
				$user_sender = $_SESSION['id'];
				$user_receiver = $this->products_model->get_product_data($product['id'])['seller']['id'];

				$data = [
					'product_id' => $product_id,
					'user_sender' => $user_sender,
					'user_receiver' => $user_receiver
				];

				$this->db->insert('notifications', $data);
			}

			// Clean shopping basket
			$_SESSION['products'] = [];

			// Redirect to the shopping basket
			redirect("members/shopping_basket");
		}

		public function register_product()
		{
			// This variable holds all the errors that were found in the server-side conprovation
			$errors = [];

			// Check title/description
			$fields = [
				'title',
				'description'
			];

			foreach ($fields as $field) {
				$min = ($field == 'title' ? 6 : 15);
				$max = ($field == 'title' ? 110 : 500);

				if (strlen($this->input->post($field)) < $min) {
					$errors[] = [
						'field' => $field,
						'msg' => "The $field is too short"
					];
				}elseif (strlen($this->input->post($field)) > $max) {
					$errors[] = [
						'field' => $field,
						'msg' => "The $field is too big"
					];
				}
			}

			// Check Product amount
			$product_amount = intval($this->input->post('count')) == 0 ? 1 : $this->input->post('count');
			$product_amount = intval($this->input->post('count')) > 999 ? 999 : $this->input->post('count');

			// Check Image
			// Re-order files array
			$file_ary = array();
			$file_count = count($_FILES['file']['name']);
			$file_keys = array_keys($_FILES['file']);

			for ($i = 0; $i < $file_count; $i++) {
				foreach ($file_keys as $key) {
					$file_ary[$i][$key] = $_FILES['file'][$key][$i];
				}
			}

			// Start uploading files to server
			for ($i = 0; $i < count($file_ary) ; $i++) {

				// var_dump($file_ary[0]);
			/*
				// Get type file
				if ($file_ary[$i]['type']) {
					preg_match('/(jpg|jpeg|png|gif)/', $file_ary[$i]['type'], $extension);
					$extension = $extension[0];
				}else {
					$split_name = explode('.', $file_ary[$i]['name']);
					$extension = end( $split_name );
				}
			*/
				// Check file type
				// if (preg_match('/(jpg|jpeg|png|gif)/', $extension, $ext)) {
				if (preg_match('/(jpg|jpeg|png|gif)/', $file_ary[$i]['type'], $ext)) {

					// Check Image size
					if ($file_ary[$i]['size'] != 0 || $file_ary[$i]['size'] < 5000000) {

						// Move file to server and hold image name to push it to database
						$image_name = $this->session->id . '-' . md5(time()) . '.' . $ext[0];
						// $image_path = __DIR__ . '/../../img/products/';
						$image_path = dirname(dirname(__DIR__)) . '/img/products/';

						// var_dump($file_ary[$i]['tmp_name']);

						move_uploaded_file($file_ary[$i]['tmp_name'], $image_path . $image_name);
						$image_names[] = $image_name;


					}else { continue; }

				}else { continue; }
			}


			// Check if there's any errors
			if (count($errors) == 0) {

				$product = [
					'amount' => $product_amount,
					'title' => $this->input->post('title'),
					'description' => $this->input->post('description'),
					'images' => implode(';', $image_names)
				];



				// Save producto to database
				$this->products_model->add_product($product);

				// Set a success message and redirect the user to the products page
				$this->session->set_flashdata('success', 1);
				redirect('members/products');
			}else {

				foreach ($errors as $item) {
					$this->session->set_flashdata($item['field'], $item['msg']);
				}

				redirect('members/add_products');
			}
		}
	}
?>
