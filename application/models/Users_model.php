<?php
	class Users_model extends CI_Model {

		public function __construct()
		{
			parent::__construct();
			$this->load->model('products_model');
		}

		public function check_credential($data)
		{
			$data['password'] = md5($data['password']);

			$query = $this->db->get_where('users', ['email' => $data['email'], 'password' => $data['password']], 1);

			if ($query->row_array()) {

				// Set the session
				$this->session->set_userdata([
					'logged_in' => true,
					'id' => $query->row_array()['id'], 'email' => $query->row_array()['email'],
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

					// Add date to the user registered
					$data['registered_on'] = date('d/m/Y');

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

		public function get_userdata()
		{
			$data = [
				'id' => $this->session->id,
				'name' => $this->session->name,
				'username' => $this->session->username,
				'lastname' => $this->session->lastname,
				'email' => $this->session->name
			];

			return $data;
		}

		public function get_userdata_from_db($id)
		{
			$id = intval($id);

			$query = $this->db->get_where('users', ['id' => $id]);
			return $query->row_array();
		}

		public function get_user_notifications($id)
		{
			$query = $this->db->get_where('notifications', ['user_receiver' => $id, 'readed' => 0]);
			$notifications_data = $query->result_array();
			$notifications = [];

			// Add thumnail to notifications
			foreach ($notifications_data as $notification) {
				$imgs = $this->products_model->get_product_data($notification['product_id'])['product']['images'];
				$img = explode(';', $imgs)[0];
				$notification['thumnail'] = $img;

				$notifications[] = $notification;
			}

			return $notifications;

		}

		public function user_metadata()
		{
			$metadata = [
				'session_data' => $this->get_userdata(),
				'notifications' => $this->get_user_notifications($_SESSION['id'])
			];

			return $metadata;
		}

		public function set_read_notification($id)
		{
			$id = intval($id);
			$data = ['readed' => 1];
			$this->db->where('id', $id);
			$this->db->update('notifications', $data);
			echo 'done';
		}
	}
?>
