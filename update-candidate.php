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
					<h4><a href="voter.php">VOTERS</a></h4>
				</li>
				<li>
					<h4><a href="candidate.php"  class="current">CANDIDATE</a></h4>
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
			<h3><a href="add-candidate.php" class="button">Add Entry</a></h5>
				<!-- END-SEARCH -->
			</header>

			<article id="article-section">
				<?php
				if (isset($_GET)) {
					$id = $_GET['id'];
					$fname = $_GET['fname'];
					$mname = $_GET['mname'];
					$lname = $_GET['lname'];
					$pos = $_GET['pos'];
				} else {
					$id = '';
					$fname ='';
					$mname ='';
					$lname ='';
					$pos ='';
				}
				if ($_SERVER['REQUEST_METHOD'] == "POST") {
					if (isset($_POST)) {
						$pfname = $_POST['fname'];
						$pmname = $_POST['mname'];
						$plname = $_POST['lname'];
						$ppos = $_POST['pos'];
						$db = Database::connect();
						$sql = "UPDATE candidate SET candidate_fname =?, candidate_mname =?, candidate_lname =? , pos_id =? WHERE candidate_id =?";
						$query = $db->prepare($sql);
						$query->execute(array($pfname, $pmname, $plname, $ppos, $id));
						Database::disconnect();
						header('location: candidate.php?success=1');
					} else {
						$db = Database::connect();
						$sql = "UPDATE candidate SET candidate_fname =?, candidate_mname =?, candidate_lname =?, pos_id =? WHERE candidate_id =?";
						$query = $db->prepare($sql);
						$query->execute(array($pfname, $pmname, $plname, $ppos, $id));
						Database::disconnect();
						header('location: candidate.php?success=0');
					}	
				}
				?>
				<div id="form-container">	
					<form action="#" method="post" name="candidate">
						<label for="">First Name</label><input type="text" placeholder="Enter Candidate First Name" name="fname" id="fname" value="<?php echo $fname; ?>">
						<label for="">Middle Name</label><input type="text" placeholder="Enter Candiate Middle Name" name="mname" id="mname" value="<?php echo $mname; ?>">
						<label for="">Last Name</label><input type="text" placeholder="Enter Candidate Last Name" name="lname" id="lname" value="<?php echo $lname; ?>">
						<label for="">Position</label>
							<select name="pos" id="pos">
								<?php 
								$db = Database::connect();
								$sql = "SELECT * FROM cposition";
								foreach($db->query($sql) as $rows) {
									echo '<option value='.$rows['position_id'].'>'.$rows['position_name'].'</option>';
								}
								 ?>
							</select>
						<input type="submit" value="Update">
					</form>
				</div>
			</article>
		</section>
	</body>
	</html>