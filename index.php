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
	$pg1 = '';
	$pg2 = '';
	$pg3 = '';
	require('header.php'); ?>
	<aside id="aside-body">
	</aside>
	<section id="section-body">
		<?php
		$msg = ''; 
		if($_GET) {
			$msg = $_GET['msg'];
		} else {
			$msg = 'Welcome to election 2015';
		}
		echo '<h3>'.$msg.'</h3>';
		 ?>
	</section>
</body>
</html>