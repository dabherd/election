<?php
require('_library/database.class.php'); 
if($_GET) {
	$voter_id1 = $_GET['voter'];
	$voter_id2 = $_GET['voter'];
	$candidate_id = $_GET['can'];
	$position_id = $_GET['pos'];

	$db = Database::connect();
	$sql = "
			UPDATE voter SET voter_action = '0' WHERE voter_id = ?;
			INSERT INTO votes VALUES(?, ?, ?)";
	$query = $db->prepare($sql);
	$query->execute(array($voter_id1, $position_id, $voter_id2, $candidate_id));
	Database::disconnect();
	header('location: index.php?msg=voting+complete');
} else {
	header('location: index.php?msg=must+login');
}
 ?>