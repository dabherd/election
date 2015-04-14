<?php
require('_library/database.class.php');
if($_GET) {
	$msg = $_GET['msg'];
} else {
	$msg = '';
} 
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
			<h3 class="white">Voter Login</h3>
			<p class="white"><?php echo $msg; ?></p>
		</header>
		<?php 
		$name = '';
		$pass = '';
		if($_SERVER['REQUEST_METHOD'] == "POST") {
			if(!empty($_POST['name']) && !empty($_POST['pass'])) {
				$name = $_POST['name'];
				$pass = $_POST['pass'];

				$db = Database::connect();
				$sql = "SELECT * FROM voter WHERE voter_fname =? AND voter_pass =?";
				$query = $db->prepare($sql);
				$query->execute(array($name, $pass));
				$data = array();
				$data = $query->fetch();
				if ($data) {
					header('location: area-vote.php?name='.$name.'&pass='.$pass.'&id='.$data[0].'&voted='.$data[6].'');
				} else {
					header('location: area.php?msg=invalid+name+password');
				}
				
			} else {
				header('location: area.php?msg=empty+fields');
			}

		} ?>
		<article id="article-section">
			<div id="form-container">
				<form action="#" method="post">
					<label for="name">First Name:</label><input type="text" name="name" id="name" placeholder="Enter First Name">
					<label for="pass" placeholder="Enter Password">Password</label><input type="text" name="pass" id="pass" placeholder="Enter Password">
					<input type="submit" value="login">
				</form>
				<a href="voter.php">See Voter List</a>
			</div>
		</article>
	</section>
</body>
</html>