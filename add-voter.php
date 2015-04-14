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
	require('header.php'); ?>
	<aside id="aside-body">
		<nav id="nav-aside">
			<ul>
				<li>
					<h4><a href="voter.php" class="current">VOTERS</a></h4>
				</li>
				<li>
					<h4><a href="candidate.php">CANDIDATE</a></h4>
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
			<h3><a href="#" class="button">Add Entry</a></h5>
				<!-- END-SEARCH -->
			</header>

			<article id="article-section">
				<?php
				$id = null;
				$pass = null;
				$first = null;
				$middle = null;
				$last = null; 
				if ($_SERVER['REQUEST_METHOD'] == "POST") {
					$id = $_POST['id'];
					$pass = $_POST['password'];
					$first = $_POST['first'];
					$middle = $_POST['middle'];
					$last = $_POST['last'];

					$db = Database::connect();
					$sql = "SELECT * FROM voter WHERE voter_id =? AND voter_fname =? AND voter_mname =? AND voter_lname =? AND voter_status = '1'";
					$query = $db->prepare($sql);
					$query->execute(array($id, $first, $middle, $last));
					Database::disconnect();
					if ($query->fetch()) {
						header('location:index.php?success=0');
					} else {
						$db = Database::connect();
						if (!empty($_POST['password']) && !empty($_POST['first'])  && !empty($_POST['last'])) {
							$sql = "INSERT INTO voter(voter_id, voter_pass, voter_fname, voter_mname, voter_lname) VALUES(?, ?, ?, ? ,?)";
							$query = $db->prepare($sql);
							$query->execute(array($id, $pass, $first, $middle, $last));
							Database::disconnect();
							header('location: voter.php?success=1');
						} else {
							header('location: voter.php?success=0');
						}	
					}

				}
				?>
				<div id="form-container">	
					<form action="#" method="post" name="voter">
						<input type="hidden" name="id" id="id" value="<?php echo rand(0, 1000); ?>">
						<label for="">Password</label><input type="text" placeholder="Enter Password" name="password" id="password">
						<label for="">First Name</label><input type="text" placeholder="Enter First Name" name="first" id="first">
						<label for="">Middle Name</label><input type="text" placeholder="Enter Middle Name" name="middle" id="middle">
						<label for="">Last Name</label><input type="text" placeholder="Enter Last Name" name="last" id="last">
						<input type="submit" value="Add">
					</form>
				</div>
			</article>
		</section>
	</body>
	</html>