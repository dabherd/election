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
				$id = null;
				$name = null;
				if (isset($_GET)) {
					$id = $_GET['id'];
					$name = $_GET['name'];
				} else {
					$id = '';
					$name ='';
				}
				if ($_SERVER['REQUEST_METHOD'] == "POST") {
					$name = $_POST['name'];
					$db = Database::connect();
					$sql = "SELECT * FROM cposition WHERE position_name =? AND position_stat = '1'";
					$query = $db->prepare($sql);
					$query->execute(array($name));
					Database::disconnect();
					if ($query->fetch()) {
						header('location:position.php?success=0');
					} else {
						$db = Database::connect();
						if (!empty($_POST['name'])) {
							$sql = "UPDATE cposition SET position_name =? WHERE position_id =?";
							$query = $db->prepare($sql);
							$query->execute(array($name, $id));
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
						<label for="">Position Name</label><input type="text" placeholder="Enter Position Name" name="name" id="name" value="<?php echo $name; ?>">
						<input type="submit" value="Update">
					</form>
				</div>
			</article>
		</section>
	</body>
	</html>