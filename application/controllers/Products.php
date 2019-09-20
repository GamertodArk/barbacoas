<?php  
	class Products extends CI_Controller {
		function __construct()
		{
			parent::__construct();

			// Only accept post requests
			if (! $_POST) {
				echo '<h1>Esta pagina esta prohibida para usuarios</h1>';
				echo '<a href="#">Ir al inicio</a>';
				exit();
			}
		}

		function get_product_data($id)
		{
			sleep(1);
			echo 'ok';
		}
	}
?>