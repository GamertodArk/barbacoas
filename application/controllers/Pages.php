<?php  
	class Pages extends CI_Controller {

		public function __construct()
		{
			parent::__construct();
			$this->load->helper('url');
			$this->load->model('users_model');
			$this->load->model('products_model');
		}

		public function view($page = 'home')
		{

			// Check if template exists
			if (! file_exists(APPPATH . 'views/templates/' . strtolower($page) . '.php')) {
				show_404();
			}

			// Get all userdata from session and pass it to view
			if ($this->session->logged_in) { $data['session_data'] = $this->users_model->get_userdata(); }

			// Get products data
			$this->db->select('id, title, images, amount');
			$products = $this->db->get('products');

			$data['products'] = $products->result();
			$data['title'] = ucfirst($page);

			$this->load->view('templates/' . strtolower($page), $data);
		}


		public function profile($id)
		{

			// If no ID is passed while the user is logged in, use the logged user id 
			if (empty($id) && $this->session->logged_in) {				
				$id = $this->users_model->get_userdata()['id'];
			}

			// Get user data from database
			$data['user_data'] = $this->users_model->get_userdata_from_db($id);

			// Get products from user
			$data['product_data'] = $this->products_model->get_product_data_of_seller($id); 

			// Get all userdata from session and pass it to view
			if ($this->session->logged_in) { $data['session_data'] = $this->users_model->get_userdata(); }

			if (NULL !== $data['user_data']) {
				$this->load->view('templates/profile.php', $data);
			}else {
				echo 'User not found';
			}
		}

		public function logout()
		{
			$this->session->sess_destroy();
			redirect('users/login');
		}

	}
?>