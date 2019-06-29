<?php  
	class Dashboard extends CI_Controller {

		public function __construct()
		{
			parent::__construct();

			// Check for sessions
			if (! $this->session->id) { redirect('users/login'); }
		}

		public function index()
		{
			echo 'This is Dashboard';
		}
	}
?>