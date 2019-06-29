<?php  
	class Users extends CI_Controller {

		public function __construct()
		{
			parent::__construct();
			$this->load->helper("url");
			// $this->load->database();
			$this->load->model('users_model');
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
			$this->load->view("templates/signup.php");
		}

		public function addUser()
		{

			$data = json_decode($this->input->post('data'), true);

			$response = $this->users_model->register_user($data);

			if (! $response['error']) {
				
				$query = $this->db->get_where('users', ['email' => $data['email']], 1);
				$user_data = $query->row_array();

				unset($user_data['password']);
				$this->session->set_userdata($user_data);

				echo json_encode($response);

			}else {
				echo json_encode($response);
			}
		}
	}
?>