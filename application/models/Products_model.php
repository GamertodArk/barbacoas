<?php  
	class Products_model extends CI_Model {
		public function __construct()
		{
			parent::__construct();
			$this->load->helper('cookie');
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

		public function get_favorites_proudcts()
		{
			if ($this->input->cookie('fav_products')) {

				$products_id = explode(';', $this->input->cookie('fav_products'));
				array_pop($products_id); // delete last element witch is always empty
				
				// $this->db->where('id', $products_id);
				// $query = $this->db->get('products');

				// return $query->result();

				// get all products data from db
				foreach ($products_id as $id) {
					$query = $this->db->get_where('products', ['id' => $id]);
					$products_data[] = $query->result();
				}

				return $products_data;

			}else {
				echo false;
			}
		}

		public function get_product_data_of_seller($userId)
		{
			$query = $this->db->get_where('products', ['user_id' => $userId]);
			return $query->result_array();
		}

		public function get_product_amount_basket()
		{
			return isset($_SESSION['products']) ? count($_SESSION['products']) : null;
		}

	}
?>