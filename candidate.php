<?php
require('_library/database.class.php'); 
?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<link rel="stylesheet" href="_css/style.css">
	<title>Candidate Index</title>
</head>
<body>
		<?php 
	$pg1 = 'curent';
	$pg2 = '';
	$pg3 = '';
	require('header.php'); ?>
	<aside id="aside-body">
		<nav id="nav-aside">
			<ul>
				<li>
					<h4><a href="voter.php" >VOTERS</a></h4>
				</li>
				<li>
					<h4><a href="candidate.php" class="current">CANDIDATE</a></h4>
				</li>
				<li>
					<h4><a href="position.php">POSITION</a></h4>
				</li>
			</ul>
		</nav>
	</aside>
	<section id="section-body">
		<header id="header-section">
			<!-- ADD -->
			<h3><a href="add-candidate.php" class="button">Add Entry</a></h5>
				<!-- END-ADD -->
				<!-- SEARCH -->
				<form action="candidate.php" method="post">
					<input name="name" id="name"type="text" placeholder="Search candidate">
				</form>
				<!-- END-SEARCH -->
			</header>

			<article id="article-section">
				<!-- TABLE -->
				<table border=1>
					<thead>
						<tr>
							<th>Id</th>
							<th>First Name</th>
							<th>Middle Name</th>
							<th>Last Name</th>
							<th>Position</th>
							<th>Action</th>
						</tr>
					</thead>
					<tbody>
						<?php
						if (!$_POST || empty($_POST['name'])) {
							$db = Database::connect();
							$sql = "SELECT candidate_id, candidate_fname, candidate_mname, candidate_lname, cposition.position_name AS pos_id FROM candidate INNER JOIN
							cposition ON candidate.pos_id = cposition.position_id WHERE candidate_stat = '1'";
							foreach($db->query($sql) as $rows) {
								echo '<tr>';
								echo '<td>'.$rows['candidate_id'].'</td>';
								echo '<td>'.$rows['candidate_fname'].'</td>';
								echo '<td>'.$rows['candidate_mname'].'</td>';
								echo '<td>'.$rows['candidate_lname'].'</td>';
								echo '<td>'.$rows['pos_id'].'</td>';
								echo '<td><a class="button" href="update-candidate.php?id='.$rows['candidate_id'].'&fname='.$rows['candidate_fname'].'
								&mname='.$rows['candidate_mname'].'&lname='.$rows['candidate_lname'].'&pos='.$rows['pos_id'].'">Update</a><a class="button" href="delete-candidate.php?id='.$rows['candidate_id'].'">Delete</a></td>';
								echo '</tr>';
							}
						} else {
							$fname = $_POST['name'];
							$mname = $_POST['name'];
							$lname = $_POST['name'];
							$db = Database::connect();
							$sql = "SELECT * FROM candidate WHERE candidate_fname LIKE ? OR candidate_mname LIKE ? OR candidate_lname LIKE ? AND candidate_stat = '1'";
							$query = $db->prepare($sql);
							$query->execute(array('0' => '%'.$fname.'%', '1' => '%'.$mname.'%', '2' => '%'.$lname.'%'));
							while ($rows = $query->fetch(PDO::FETCH_ASSOC)) {
								echo '<tr>';
								echo '<td>'.$rows['candidate_id'].'</td>';
								echo '<td>'.$rows['candidate_fname'].'</td>';
								echo '<td>'.$rows['candidate_mname'].'</td>';
								echo '<td>'.$rows['candidate_lname'].'</td>';
								echo '<td>'.$rows['pos_id'].'</td>';
								echo '<td><a class="button" href="update-candidate.php?id='.$rows['candidate_id'].'&fname='.$rows['candidate_fname'].'
								&mname='.$rows['candidate_mname'].'&lname='.$rows['candidate_lname'].'&pos='.$rows['pos_id'].'">Update</a><a class="button" href="delete-candidate.php?id='.$rows['candidate_id'].'">Delete</a></td>';
								echo '</tr>';
							}
							Database::disconnect();
						}
						?>

					</tbody>
				</table>
				<!-- END-TABLE -->

			</article>
		</section>
	</body>
	</html>