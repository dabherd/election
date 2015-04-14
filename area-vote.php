<?php
if($_GET) {
	$name = $_GET['name'];
	$pass = $_GET['pass'];
	$id = $_GET['id'];
	$vid = $_GET['voted'];

	if ($_GET['voted'] == '0') {
		header('location: area.php?msg=user+already+voted');
	}
} else {
	header('location: area.php?msg=loginfirst');
}
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
	$pg1 = '';
	$pg2 = 'current';
	$pg3 = '';
	require('header.php');
	?>
	<aside id="aside-body">
	</aside>
	<section id="section-body">
		<header id="header-section">
			<!-- ADD -->
			<h3 class="white">Voter Login</a></h3>
			<!-- END-ADD -->
		</header>
		<article id="article-section">
			<table border=1>
				<thead>
					<tr>
						<th>Position</th>
						<th>First Name</th>
						<th>Middle Name</th>
						<th>Last Name</th>
						<th>Action</th>
					</tr>
				</thead>
				<tbody>
					<?php
					$db = Database::connect();
					$sql = "SELECT *, cposition.position_name AS position FROM candidate INNER JOIN
					cposition ON candidate.pos_id = cposition.position_id WHERE candidate_stat = '1'";
					foreach($db->query($sql) as $rows) {
						echo '<tr>';
						echo '<td>'.$rows['position'].'</td>';
						echo '<td>'.$rows['candidate_fname'].'</td>';
						echo '<td>'.$rows['candidate_mname'].'</td>';
						echo '<td>'.$rows['candidate_lname'].'</td>';
						echo '<td><a class="button" href="election-update.php?pos='.$rows['pos_id'].'&can='.$rows['candidate_id'].'&voter='.$id.'">Vote</a></td>';
						echo '</tr>';
					}	
				?>
			</tbody>
		</table>
	</article>
</section>
</body>
</html>