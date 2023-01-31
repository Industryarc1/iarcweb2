<?php 
class Functions{
	function __construct(){
		global $mysqli;
		$this->db = $mysqli;
	}
	function getProdCats(){
		if ($stmt = $mysqli->prepare("select inc_id,name from zsp_catlog_categories")) {
			echo "Prepare failed: (" . $mysqli->errno . ") " . $mysqli->error;
			$stmt->execute();
			$stmt->store_result();
			$stmt->bind_result($inc_id, $name);
			while( $stmt->fetch() ) {
				$categories[] = array( $inc_id => $name);
			}
			return $categories;
		}else{
		//echo "Prepare failed: (" . $mysqli->errno . ") " . $mysqli->error;
		}
	}
}

?> 