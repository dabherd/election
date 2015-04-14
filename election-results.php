<?php
require('_library/database.class.php'); 
?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<link rel="stylesheet" href="_css/style.css">
	<title>Election Results</title>
</head>
<body>
	<?php 
	$pg1 = '';
	$pg2 = '';
	$pg3 = 'current';
	require('header.php'); ?>
	<aside id="aside-body">
	</aside>
	<section id="section-body">
		<header id="header-section">
			<h3 class="white">Election Results</a></h3>
		</header>
		<article id="article-section">
			<table border=1>
				<thead>
					<tr>
						<th></th>
						<th>Position</th>
						<th>Winner</th>
						<th>Total Votes</th>
					</tr>
				</thead>
				<tbody>
					<?php
					$db = Database::connect();
					$sql = "select 
					'Winner' as winner,
					cposition.position_name as position,
					candidate.candidate_fname as candidate,
					max(total) as total_votes
					from
					(
						select count(*) as total, candidate_id, pos_id from votes group by candidate_id
						)
tmp
inner join cposition on tmp.pos_id = cposition.position_id
inner join candidate on tmp.candidate_id = candidate.candidate_id
group by tmp.pos_id
";
foreach($db->query($sql) as $rows) {
	echo '<tr>';
	echo '<td>'.$rows['winner'].'</td>';
	echo '<td>'.$rows['position'].'</td>';
	echo '<td>'.$rows['candidate'].'</td>';
	echo '<td>'.$rows['total_votes'].'</td>';
	echo '</tr>';
}	
?>
</tbody>
</table>
</article>
</section>
</body>
</html>