<?php  
	class Pages extends CI_Controller {

		public function __construct()
		{
			parent::__construct();
			$this->load->helper('url');
		}

		public function view($page = 'home')
		{
			// Check if template exists
			if (! file_exists(APPPATH . 'views/templates/' . strtolower($page) . '.php')) {
				show_404();
			}
			// var_dump($this->session->password);

			$data['title'] = ucfirst($page);

			if ($this->session->logged_in) {
				$data['id'] = $this->session->id;
				$data['name'] = $this->session->name;
				$data['username'] = $this->session->username;
				$data['lastname'] = $this->session->lastname;
				$data['email'] = $this->session->name;
			}

			$this->load->view('templates/' . strtolower($page), $data);
		}

		public function logout()
		{
			$this->session->sess_destroy();
			redirect('users/login');
		}

	}
?>