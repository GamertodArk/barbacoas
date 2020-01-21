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

		public function get_random_products($amount, $exclude_id = NULL)
		{
			// select max id of products
			$this->db->select_max('id');
			$query = $this->db->get('products');
			$maxId = intval($query->result_array()[0]['id']);

			$products = [];

			for ($i = 1; $i <= $maxId ; $i++) {

				if (count($products) <= ($amount - 1)) {

					$random_id = mt_rand(1, $maxId);

					$this->db->select('id, title, images, amount');
					$this->db->where('id', $random_id);
					$query = $this->db->get('products');
					$result = $query->result();

					// Check that the product is not null
					// check that the product is not in the products array
					// and check if the product got from the db is not already on the array
					if (NULL != $result && !in_array($result, $products) && $result[0]->id != $exclude_id) {
						$products[] = $query->result();
					}else {
						continue;
					}

				}
			}

			return $products;
		}

		public function search_products($query)
		{
			$queries = preg_split('/[\s|%20|+]+/', $query);

			// foreach ($queries as $query) {
			// 	if (empty($query) || '' == $query) {
			// 		unset($query);
			// 	}
			// }

			// return $queries;
			// exit();

			for ($i = 0; $i < count($queries); $i++) {
				if (/*' ' == $queries[$i] ||*/ empty($queries[$i])) { continue; }

				$this->db->or_like('title', $queries[$i]);
				$this->db->or_like('description', $queries[$i]);				
			}

			$query = $this->db->get('products');
			return $query->result();
		}

		public function get_favorites_proudcts()
		{
			if ($this->input->cookie('fav_products')) {

				$products_id = explode(';', $this->input->cookie('fav_products'));
				array_pop($products_id); // delete last element witch is always empty

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

		public function check_if_is_in_favorites($id)
		{
			$favP = $this->input->cookie('fav_products', true);
			$list_fav_p = explode(';', $favP);

			if (in_array(intval($id), $list_fav_p)) {
				return true;
			}else {
				return false;
			}

		}

		public function get_specific_product_data($select_field)
		{
			$this->db->select($select_field);
			$products = $this->db->get('products');

			return $products->result();

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