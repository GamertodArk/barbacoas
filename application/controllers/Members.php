<?php  
	class Members extends CI_Controller {
		public function __construct()
		{
			parent::__construct();
			$this->load->model('users_model');
			$this->load->model('products_model');

			// Check for sessions
			if (! $this->session->logged_in) { redirect('users/login'); }
		}

		public function page($page = NULL)
		{

			// Check if template exists
			if (! file_exists(APPPATH . 'views/templates/' . strtolower($page) . '.php')) {
				show_404();
			}

			// Get all userdata from session and pass it to view
			if ($this->session->logged_in) { $data = $this->users_model->get_userdata(); }

			$this->load->view('templates/' . strtolower($page), $data);
		}

		public function register_product()
		{
			// This variable holds all the errors that were found in the server-side conprovation
			$errors = [];

			// Check title/description
			$fields = [
				// $this->input->post('title'),
				// $this->input->post('description')
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
				// $file_ary

				// Check file type
				if (preg_match('/(jpg|jpeg|png|gif)/', $file_ary[$i]['type'], $matches)) {

					// Check Image size
					if ($file_ary[$i]['size'] != 0 || $file_ary[$i]['size'] < 5000000) {
						
						// Move file to server and hold image name to push it to database
						$image_name = $this->session->id . '-' . md5(time()) . '.' . $matches[0];
						$image_path = __DIR__ . '\..\..\img\products\\';

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