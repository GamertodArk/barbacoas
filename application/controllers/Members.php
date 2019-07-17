<?php  
	class Members extends CI_Controller {
		public function __construct()
		{
			parent::__construct();

			// Check for sessions
			if (! $this->session->logged_in) { redirect('users/login'); }
		}

		public function products()
		{
			// echo 'products';
			$this->load->view('templates/products');
		}
	}
?>