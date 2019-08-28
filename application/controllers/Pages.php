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

			// $data = $this->db->get('products')->result();
			// var_dump($data);

			// Check if template exists
			if (! file_exists(APPPATH . 'views/templates/' . strtolower($page) . '.php')) {
				show_404();
			}

			// Get all userdata from session and pass it to view
			if ($this->session->logged_in) { $data = $this->users_model->get_userdata(); }
			$data['title'] = ucfirst($page);
			$data['products'] = $this->db->get('products')->result();

			$this->load->view('templates/' . strtolower($page), $data);
		}

		public function logout()
		{
			$this->session->sess_destroy();
			redirect('users/login');
		}

	}
?>