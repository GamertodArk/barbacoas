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

		public function product_summary($id)
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

			// Check if the product existe
			if (NULL != $data['productData']['product']) {
				$this->load->view('templates/product_summary', $data);
			}else {
				$this->load->view('templates/product_not_found', $data);
			}

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
				// echo 'User not found';
				$this->load->view('templates/user_not_found.php');
			}
		}

		public function logout()
		{
			$this->session->sess_destroy();
			redirect('users/login');
		}

	}
?>