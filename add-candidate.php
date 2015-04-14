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
					<h4><a href="voters.php" >VOTERS</a></h4>
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
				<!-- END-SEARCH -->
			</header>

			<article id="article-section">
				<?php
				$id = null;
				$first = null;
				$middle = null;
				$last = null; 
				$pos = null;
				if ($_SERVER['REQUEST_METHOD'] == "POST") {
					$id = $_POST['id'];
					$first = $_POST['first'];
					$middle = $_POST['middle'];
					$last = $_POST['last'];
					$pos = $_POST['position'];

					$db = Database::connect();
					$sql = "SELECT * FROM candidate WHERE candidate_id =? AND candidate_fname =? AND candidate_mname =? AND candidate_lname =? AND candidate_status = '1'";
					$query = $db->prepare($sql);
					$query->execute(array($id, $first, $middle, $last));
					Database::disconnect();
					if ($query->fetch()) {
						header('location:candidate.php?success=0');
					} else {
						$db = Database::connect();
						if (!empty($_POST['first'])  && !empty($_POST['last'])) {
							$sql = "INSERT INTO candidate(candidate_id, candidate_fname, candidate_mname, candidate_lname, pos_id) VALUES(?, ?, ?, ? ,?)";
							$query = $db->prepare($sql);
							$query->execute(array($id, $first, $middle, $last, $pos));
							Database::disconnect();
							header('location: candidate.php?success=1');
						} else {
							header('location: candidate.php?success=0');
						}	
					}

				}
				?>
				<div id="form-container">	
					<form action="#" method="post" name="candidate">
						<input type="hidden" name="id" id="id" value="<?php echo rand(0, 1000); ?>">
						<label for="">First Name</label><input type="text" placeholder="Enter First Name" name="first" id="first">
						<label for="">Middle Name</label><input type="text" placeholder="Enter Middle Name" name="middle" id="middle">
						<label for="">Last Name</label><input type="text" placeholder="Enter Last Name" name="last" id="last">
						<label for="">Position</label>
						<select name="position" id="position">
							<option >Select Position</option>
							<?php 
							$db = Database::connect();
							$sql = "SELECT * FROM cposition";
							foreach($db->query($sql) as $rows) {
								echo '<option value='.$rows['position_id'].'>'.$rows['position_name'].'</option>';
							}
							Database::disconnect();
							 ?>
						</select>
						<input type="submit" value="Add">
					</form>
				</div>
			</article>
		</section>
	</body>
	</html>