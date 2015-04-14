<?php
require('_library/database.class.php'); 
if($_GET) {
	$id = $_GET['id'];

	$db = Database::connect();
	$sql = "UPDATE candidate SET candidate_stat = '0' WHERE candidate_id =?";
	$query = $db->prepare($sql);
	$query->execute(array($id));
	header('location: candidate.php?msg=deleted');
}
 ?>