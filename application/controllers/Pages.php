<?php
	class Pages extends CI_Controller {

		private $data;

		public function __construct()
		{
			parent::__construct();
			$this->load->helper('url');
			$this->load->model('users_model');
			$this->load->model('products_model');

			// Get information from session and unread notifications
			if ($this->session->logged_in) {
				$this->data = $this->users_model->user_metadata($_SESSION['id']);
			}

		}

		public function view($page = 'home')
		{
			// Check if template exists
			if (! file_exists(APPPATH . 'views/templates/' . strtolower($page) . '.php')) {
				show_404();
			}

			// Get products data
			$this->data['products'] = $this->products_model->get_specific_product_data('id, title, images, amount');

			// Set tittle with the first letter uppercase
			$this->data['title'] = ucfirst($page);

			$this->load->view('templates/' . strtolower($page), $this->data);
		}

		public function product_summary($id)
		{
			// Get product and seller data
			$this->data['productData'] = $this->products_model->get_product_data($id);

			// Other products data
			$this->data['products'] = $this->products_model->get_random_products(4, $id);

			// Check if this product is in the favorite list
			$this->data['isInFav'] = $this->products_model->check_if_is_in_favorites($id);

			// Check if the product existe
			if (NULL != $this->data['productData']['product']) {
				$this->load->view('templates/product_summary', $this->data);
			}else {
				$this->load->view('templates/product_not_found', $this->data);
			}
		}

		public function search($query = null)
		{

			// Get all userdata from session and pass it to view
			if ($this->session->logged_in) { $data['session_data'] = $this->users_model->get_userdata(); }else {$data['session_data'] = false;}

			$query = !empty($this->input->get('search')) ? $this->input->get('search') : $query;

			if (null != $query && !empty($query)) {
				$this->data['query'] = strip_tags($query);
				$this->data['products'] = $this->products_model->search_products($query);
				$this->load->view('templates/search_results', $this->data);
			}else {
				$this->load->view('templates/search_template', $this->data);
			}
		}

		public function profile($id)
		{

			// If no ID is passed while the user is logged in, use the logged user id
			if (empty($id) && $this->session->logged_in) {
				$id = $this->users_model->get_userdata()['id'];
			}

			// Get user data from database
			$this->data['user_data'] = $this->users_model->get_userdata_from_db($id);

			// Get products from user
			$this->data['product_data'] = $this->products_model->get_product_data_of_seller($id);

			if (NULL !== $this->data['user_data']) {
				$this->load->view('templates/profile.php', $this->data);
			}else {
				// echo 'User not found';
				$this->load->view('templates/user_not_found.php', $this->data);
			}
		}

		public function logout()
		{
			$this->session->sess_destroy();
			redirect('users/login');
		}

	}
?>
