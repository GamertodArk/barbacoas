<?php  
	class Users_model extends CI_Model {

		public function __construct()
		{
			parent::__construct();
		}

		public function check_credential($data)
		{
			$data['password'] = md5($data['password']);

			$query = $this->db->get_where('users', ['email' => $data['email'], 'password' => $data['password']], 1);

			if ($query->row_array()) {

				// Set the session
				$this->session->set_userdata([
					'logged_in' => true,
					'id' => $query->row_array()['id'],
					'email' => $query->row_array()['email'],
					'name' => $query->row_array()['name'],
					'lastname' => $query->row_array()['name'],
					'username' => $query->row_array()['username']
				]);

				$json = ['error' => false];
			}else {
				$json = ['error' => true];
			}

			return $json;
		}

		public function register_user($data)
		{
			// Check for Email availability
			$query = $this->db->get_where('users', ['email' => $data['email']]);
			if ($query->row_array() == NULL) {
				
				// Check username availability
				$query2 = $this->db->get_where('users', ['username' => $data['username']]);
				if ($query2->row_array() == NULL) {

					// Encrypt the password
					$data['password'] = md5($data['password']);
					
					// Isert data to database
					$this->db->insert('users', $data);


					// Create success message
					$json = [
						'error' => false,
						'field' => NULL,
						'message' => 'Registrado con exito'
					];

					return $json;


				}else {
					// Send error message
					$json = [
						'error' => true,
						'field' => 'username',
						'message' => 'Username esta en uso'
					];

					return $json;
				}

			} else {
				// Send error message
				$json = [
					'error' => true,
					'field' => 'email',
					'message' => 'Email esta en uso'
				];

				return $json;
			}
		}
	}
?>