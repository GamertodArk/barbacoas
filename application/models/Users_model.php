<?php  
	class Users_model extends CI_Model {

		public function __construct()
		{
			parent::__construct();
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