<?php
require('_library/database.class.php'); 
?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<link rel="stylesheet" href="_css/style.css">
	<title>candidate Index</title>
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
				<!-- END-SEARCH -->
			</header>

			<article id="article-section">
				<?php
				$name = null;
				if ($_SERVER['REQUEST_METHOD'] == "POST") {
					$id = $_POST['id'];
					$name = $_POST['name'];

					$db = Database::connect();
					$sql = "SELECT * FROM cposition WHERE position_id =? AND position_name =? AND position_stat = '1'";
					$query = $db->prepare($sql);
					$query->execute(array($id, $name));
					Database::disconnect();
					if ($query->fetch()) {
						header('location:position.php?success=0');
					} else {
						$db = Database::connect();
						if (!empty($_POST['name'])) {
							$sql = "INSERT INTO cposition(position_id, position_name) VALUES(?, ?)";
							$query = $db->prepare($sql);
							$query->execute(array($id, $name));
							Database::disconnect();
							header('location: position.php?success=1');
						} else {
							header('location: position.php?success=0');
						}	
					}

				}
				?>
				<div id="form-container">	
					<form action="#" method="post" name="candidate">
						<input type="hidden" name="id" id="id" value="<?php echo rand(0, 1000); ?>">
						<label for="">Position Name</label><input type="text" placeholder="Enter Position Name" name="name" id="name">
						<input type="submit" value="Add">
					</form>
				</div>
			</article>
		</section>
	</body>
	</html>