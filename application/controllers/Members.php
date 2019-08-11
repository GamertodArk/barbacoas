<?php  
	class Members extends CI_Controller {
		public function __construct()
		{
			parent::__construct();
			$this->load->model('users_model');

			// Check for sessions
			if (! $this->session->logged_in) { redirect('users/login'); }
		}

		public function page($page = NULL)
		{


			// if ($this->session->flashdata('test')) {
			// 	echo $this->session->flashdata('test');
			// 	die();
			// }

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
			// var_dump($this->input->post());
			$this->session->set_flashdata('test', 'This is a test message');
			redirect('members/add_products');
		}

		public function upload_picture()
		{
			// echo 'Hi there';
			// var_dump($this->input->post());
			var_dump($_FILES);
		}
	}
?>