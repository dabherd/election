<?php
require('_library/database.class.php'); 
?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<link rel="stylesheet" href="_css/style.css">
	<title>Position Index</title>
</head>
<body>
			<?php 
	$pg1 = 'current';
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
					<h4><a href="candidate.php">CANDIDATE</a></h4>
				</li>
				<li>
					<h4><a href="position.php" class="current">POSITION</a></h4>
				</li>
			</ul>
		</nav>
	</aside>
	<section id="section-body">
		<header id="header-section">
			<!-- ADD -->
			<h3><a href="add-position.php" class="button">Add Entry</a></h5>
				<!-- END-ADD -->
				<!-- SEARCH -->
				<form action="position.php" method="post">
					<input name="name" id="name"type="text" placeholder="Search Position">
				</form>
				<!-- END-SEARCH -->
			</header>
			<article id="article-section">
				<!-- TABLE -->
				<table border=1>
					<thead>
						<tr>
							<th>Id</th>
							<th>Name</th>							
							<th>Status</th>
							<th>Action</th>							
						</tr>
					</thead>
					<tbody>
						<?php
						if (!$_POST && empty($_POST['name'])) {
							$db = Database::connect();
							$sql = "SELECT * FROM cposition WHERE position_stat = '1'";
							foreach($db->query($sql) as $rows) {
								echo '<tr>';
								echo '<td>'.$rows['position_id'].'</td>';
								echo '<td>'.$rows['position_name'].'</td>';
								echo '<td>'.$rows['position_stat'].'</td>';
								echo '<td><a class="button" href="update-position.php?id='.$rows['position_id'].'&name='.$rows['position_name'].'">Update</a><a class="button" href="delete-position.php?id='.$rows['position_id'].'">Delete</a></td>';								
								echo '</tr>';
							}
						} else {
							$pname = $_POST['name'];
							$db = Database::connect();
							$sql = "SELECT * FROM cposition WHERE position_name LIKE ? AND position_stat ='1' ";
							$query = $db->prepare($sql);
							$query->execute(array('0' => '%'.$pname.'%'));
							while ($rows = $query->fetch(PDO::FETCH_ASSOC)) {
								echo '<tr>';
								echo '<td>'.$rows['position_id'].'</td>';
								echo '<td>'.$rows['position_name'].'</td>';
								echo '<td>'.$rows['position_stat'].'</td>';
								echo '<td><a class="button" href="update-position.php?id='.$rows['position_id'].'&name='.$rows['position_name'].'">Update</a><a class="button" href="delete-position.php?id='.$rows['position_id'].'">Delete</a></td>';	
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