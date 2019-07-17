<?php  
	class Users extends CI_Controller {

		public function __construct()
		{
			parent::__construct();
			$this->load->helper("url");
			$this->load->model('users_model');

			// Check for sessions
			if ($this->session->logged_in) { redirect('home'); }
		}

		public function index()
		{
			echo "You're in the users Controller";
		}

		public function login()
		{
			$this->load->view('templates/login');
		}

		public function signup()
		{
			$this->load->view("templates/signup.php");
		}

		public function done()
		{
			redirect('home');
		}

		public function verify()
		{
			$data = json_decode($this->input->post('data'), true);
			$response = $this->users_model->check_credential($data);

			echo json_encode($response);
			}

		public function addUser()
		{

			$data = json_decode($this->input->post('data'), true);

			$response = $this->users_model->register_user($data);

			if (! $response['error']) {
				
				$query = $this->db->get_where('users', ['email' => $data['email']], 1);

				$this->session->set_userdata([
					'logged_in' => true,
					'id' => $query->row_array()['id'],
					'email' => $query->row_array()['email'],
					'name' => $query->row_array()['name'],
					'lastname' => $query->row_array()['name'],
					'username' => $query->row_array()['username']
				]);

				echo json_encode($response);

			}else {
				echo json_encode($response);
			}
		}
	}
?>