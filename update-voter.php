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
					<h4><a href="voter.php" class="current">VOTERS</a></h4>
				</li>
				<li>
					<h4><a href="candidate.php">CANDIDATE</a></h4>
				</li>
				<li>
					<h4><a href="position.php" >POSITION</a></h4>
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
				if (isset($_GET)) {
					$id = $_GET['id'];
					$pass = $_GET['pass'];
					$fname = $_GET['fname'];
					$mname = $_GET['mname'];
					$lname = $_GET['lname'];
				} else {
					$id = '';
					$pass ='';
					$fname ='';
					$mname ='';
					$lname ='';
				}
				if ($_SERVER['REQUEST_METHOD'] == "POST") {
					if (isset($_POST)) {
						$ppass = $_POST['pass'];
						$pfname = $_POST['fname'];
						$pmname = $_POST['mname'];
						$plname = $_POST['lname'];
						$db = Database::connect();
						$sql = "UPDATE voter SET voter_pass =?, voter_fname =?, voter_mname =?, voter_lname =? WHERE voter_id =?";
						$query = $db->prepare($sql);
						$query->execute(array($ppass, $pfname, $pmname, $plname, $id));
						Database::disconnect();
						header('location: voter.php?success=1');
					} else {
						$db = Database::connect();
						$sql = "UPDATE voter SET voter_pass =?, voter_fname =?, voter_mname =?, voter_lname =? WHERE voter_id =?";
						$query = $db->prepare($sql);
						$query->execute(array($pass, $fname, $mname, $lname, $id));
						Database::disconnect();
						header('location: voter.php?success=0');
					}	
				}
				?>
				<div id="form-container">	
					<form action="#" method="post" name="candidate">
						<label for="">Password</label><input type="text" placeholder="Enter Position Name" name="pass" id="pass" value="<?php echo $pass; ?>">
						<label for="">First Name</label><input type="text" placeholder="Enter Position Name" name="fname" id="fname" value="<?php echo $fname; ?>">
						<label for="">Middle Name</label><input type="text" placeholder="Enter Position Name" name="mname" id="mname" value="<?php echo $mname; ?>">
						<label for="">Last Name</label><input type="text" placeholder="Enter Position Name" name="lname" id="lname" value="<?php echo $lname; ?>">
						<input type="submit" value="Update">
					</form>
				</div>
			</article>
		</section>
	</body>
	</html>