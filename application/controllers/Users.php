<?php  
	class Users extends CI_Controller {

		public function __construct()
		{
			parent::__construct();
			$this->load->helper("url");
		}

		public function index()
		{
			echo "You're in the users Controller";
		}

		public function login()
		{
			echo "This is the login page";
		}

		public function signup()
		{
			/*
				Usarname
				Name
				Last Name
				contry, state, city
			*/
			$this->load->view("templates/signup.php");
		}

		public function addUser()
		{
			// echo 'Recibido';
			// var_dump($_POST['data']);
			$data = json_decode($_POST['data'], true);
			echo $data['name'];
		}
	}
?>