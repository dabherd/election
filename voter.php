<?php
require('_library/database.class.php'); 
?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<link rel="stylesheet" href="_css/style.css">
	<title>Voter Index</title>
</head>
<body>
	<?php 
	$pg1 = 'current';
	$pg2 = '';
	$pg3 = '';
	require('header.php');
	require('side.php') ?>
	<section id="section-body">
		<header id="header-section">
			<h3><a href="add-voter.php" class="button">Add Entry</a></h3>
			<form action="voter.php" method="post">
				<input name="name" id="name"type="text" placeholder="Search Voter">
			</form>
		</header>
		<article id="article-section">
			<table border=1>
				<thead>
					<tr>
						<th>Id</th>
						<th>Pass</th>
						<th>First Name</th>
						<th>Middle Name</th>
						<th>Last Name</th>
						<th>Voted</th>
						<th>Action</th>
					</tr>
				</thead>
				<tbody>
					<?php
					if (!$_POST && empty($_POST['name'])) {
						$db = Database::connect();
						$sql = "SELECT * FROM voter WHERE voter_status = '1'";
						foreach($db->query($sql) as $rows) {
							echo '<tr>';
							echo '<td>'.$rows['voter_id'].'</td>';
							echo '<td>'.$rows['voter_pass'].'</td>';
							echo '<td>'.$rows['voter_fname'].'</td>';
							echo '<td>'.$rows['voter_mname'].'</td>';
							echo '<td>'.$rows['voter_lname'].'</td>';
							echo '<td>'.$rows['voter_action'].'</td>';
							echo '<td><a class="button" href="update-voter.php?id='.$rows['voter_id'].'&pass='.$rows['voter_pass'].'&fname='.$rows['voter_fname'].'&mname='.$rows['voter_mname'].'&lname='.$rows['voter_lname'].'">update</a>
							<a class="button" href="delete-voter.php?id='.$rows['voter_id'].'">delete</a></td>';
							echo '</tr>';
						}
					} else {
						$fname = $_POST['name'];
						$mname = $_POST['name'];
						$lname = $_POST['name'];
						$db = Database::connect();
						$sql = "SELECT * FROM voter WHERE voter_fname LIKE ? OR voter_mname LIKE ? OR voter_lname LIKE ? AND voter_status = '1' ";
						$query = $db->prepare($sql);
						$query->execute(array('0' => '%'.$fname.'%', '1' => '%'.$mname.'%', '2' => '%'.$lname.'%'));
						while ($rows = $query->fetch(PDO::FETCH_ASSOC)) {
							echo '<tr>';
							echo '<td>'.$rows['voter_id'].'</td>';
							echo '<td>'.$rows['voter_pass'].'</td>';
							echo '<td>'.$rows['voter_fname'].'</td>';
							echo '<td>'.$rows['voter_mname'].'</td>';
							echo '<td>'.$rows['voter_lname'].'</td>';
							echo '<td>'.$rows['voter_action'].'</td>';
							echo '<td><a class="button" href="update-voter.php?id='.$rows['voter_id'].'&pass='.$rows['voter_pass'].'&fname='.$rows['voter_fname'].'&mname='.$rows['voter_mname'].'&lname='.$rows['voter_lname'].'">update</a>
							<a class="button" href="delete-voter.php?id='.$rows['voter_id'].'">delete</a></td>';
							echo '</tr>';
							echo '</tr>';
						}
						Database::disconnect();
					}
					?>
				</tbody>
			</table>
		</article>
	</section>
</body>
</html>