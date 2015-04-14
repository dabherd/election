<?php
require('_library/database.class.php'); 
if($_GET) {
	$id = $_GET['id'];

	$db = Database::connect();
	$sql = "UPDATE voter SET voter_status = '0' WHERE voter_id =?";
	$query = $db->prepare($sql);
	$query->execute(array($id));
	header('location: voter.php?msg=deleted');
}
 ?>