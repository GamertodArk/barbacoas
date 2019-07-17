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
			// Get all userdata from session and pass it to view
			if ($this->session->logged_in) { $data = $this->users_model->get_userdata(); }

			// Check if template exists
			if (! file_exists(APPPATH . 'views/templates/' . strtolower($page) . '.php')) {
				show_404();
			}

			$this->load->view('templates/' . strtolower($page), $data);
		}

		// public function FunctionName($value='')
		// {
		// 	# code...
		// }

		public function profile()
		{
		}
	}
?>