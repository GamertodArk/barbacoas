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

		public function get_product_data($id)
		{
			$query = $this->db->get_where('products', ['id' => $id]);
			return $query->row_array();
		}
	}
?>