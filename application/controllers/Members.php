<?php  
	class Members extends CI_Controller {
		public function __construct()
		{
			parent::__construct();

			$this->load->helper('cookie');
			$this->load->model('users_model');
			$this->load->model('products_model');

			// Check for sessions
			if (! $this->session->logged_in) { redirect('users/login'); }
		}

		function product_summary($id)
		{

			// Get all userdata from session and pass it to view
			if ($this->session->logged_in) { $data['session_data'] = $this->users_model->get_userdata(); }

			// Get product and seller data
			$data['productData'] = $this->products_model->get_product_data($id);

			// Other products data
			$this->db->select('id, title, images, amount');
			$query = $this->db->get('products', 4);
			$data['products'] = $query->result();

			// Check if this product is in the favorite list
			$favP = $this->input->cookie('fav_products', true);
			$list_fav_p = explode(';', $favP);
			$data['isInFav'] = in_array(intval($id), $list_fav_p) ? true : false; 


			$this->load->view('templates/product_summary', $data);

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

			// Get all userdata from session and pass it to view
			if ($this->session->logged_in) { $data['session_data'] = $this->users_model->get_userdata(); }

			// Get products data
			$this->db->select('id, title, images');
			$products = $this->db->get('products');
			$data['products'] = $products->result();


			// Get amount of products in the basket
			$data['products_basket_amount'] = $this->products_model->get_product_amount_basket();

			// Get favorites products
			$data['favorites'] = $this->products_model->get_favorites_proudcts();

			// var_dump($data['favorites'][0][0]);
			$this->load->view('templates/' . strtolower($page), $data);
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