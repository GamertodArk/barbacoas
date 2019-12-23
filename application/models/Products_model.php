<?php  
	class Products_model extends CI_Model {
		public function __construct()
		{
			parent::__construct();
		}

		public function add_product($product)
		{
			$product['user_id'] = $this->session->id; 
			$product['created_on'] = date('d/m/Y');
			$this->db->insert('products', $product);
		}

		public function get_seller_data($id)
		{
			$this->db->select('id, username');
			$query = $this->db->get_where('users', ['id' => $id]);
			return $query->row_array();
		}

		public function get_product_data($id)
		{
			$query = $this->db->get_where('products', ['id' => $id]);
			$data['product'] = $query->row_array();
			$data['seller'] = $this->get_seller_data($data['product']['user_id']);

			return $data;
		}

		public function get_product_data_of_seller($userId)
		{
			$query = $this->db->get_where('products', ['user_id' => $userId]);
			return $query->result_array();
		}

	}
?>