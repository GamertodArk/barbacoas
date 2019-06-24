<?php  
	class Users extends CI_Controller {

		public function __construct()
		{
			parent::__construct();
			$this->load->helper("url");
			$this->load->database();
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

			$data = json_decode($_POST['data'], true);
			// var_dump($data);

			// Check for Email availability
			$query = $this->db->get_where('users', ['email' => $data['email']]);
			if ($query->row_array() == NULL) {
				
				// Check username availability
				$query2 = $this->db->get_where('users', ['username' => $data['username']]);
				if ($query2->row_array() == NULL) {
					
					echo 'Nada en uso';

				}else {
					// Send error message
					$json = [
						'error' => true,
						'field' => 'username',
						'message' => 'Username esta en uso'
					];

					echo json_encode($json);
				}

			} else {
				// Send error message
				$json = [
					'error' => true,
					'field' => 'email',
					'message' => 'Email esta en uso'
				];

				echo json_encode($json);
			}

			// var_dump($query->row_array());


			// $this->db->insert('users', $data);

		}
	}
?>