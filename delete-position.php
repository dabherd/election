<?php
require('_library/database.class.php'); 
if($_GET) {
	$id = $_GET['id'];

	$db = Database::connect();
	$sql = "UPDATE cposition SET position_stat = '0' WHERE position_id =?";
	$query = $db->prepare($sql);
	$query->execute(array($id));
	header('location: position.php?msg=deleted');
}
 ?>