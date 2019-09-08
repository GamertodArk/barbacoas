<?php  
	class Pages extends CI_Controller {

		public function __construct()
		{
			parent::__construct();
			$this->load->helper('url');
			$this->load->model('users_model');
		}

		public function view($page = 'home')
		{

			// Check if template exists
			if (! file_exists(APPPATH . 'views/templates/' . strtolower($page) . '.php')) {
				show_404();
			}

			// Get all userdata from session and pass it to view
			if ($this->session->logged_in) { $data = $this->users_model->get_userdata(); }

			// Get products data
			$this->db->select('id, title, images');
			$products = $this->db->get('products');

			$data['products'] = $products->result();
			$data['title'] = ucfirst($page);

			$this->load->view('templates/' . strtolower($page), $data);
		}

		public function logout()
		{
			$this->session->sess_destroy();
			redirect('users/login');
		}

	}
?>