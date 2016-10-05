
<!-- the top HTML section -->
<?php 
	include 'top.html';
	include 'config.php'; //IMDB database settings 
	
	
	$conn=mysqli_connect($servername,$username,$password,$dbname);

	if (!$conn) {
		die("Connection failed.");
	}

	$id = $_REQUEST["actor_id"];
	$fullname = $_REQUEST["actor_name"];
	$eric = $_REQUEST["eric"];
	if ($eric!= "yes")
		$sql = "select m.name, m.year from movies m join roles r on r.movies_id = m.id join actors a on a.id = r.actor_id where a.id = $id order by m.year desc, m.name;";
	else
		$sql = "select m.name, m.year from movies m join roles r1 on r1.movies_id = m.id join actors a1 on a1.id = r1.actor_id join roles r2 on r2.movie_id = m.id join actors a2 on a2.id = r2.actor_id where a1.id = $id and a2.first_name = "Eric" and a2.last_name = "Roberts" order by m.year desc, m.name;"; 

	$results = mysqli_query($conn, $sql);
	if (!$results){
		echo("Error");
	} else {
		if (mysqli_num_rows($results) >0) {
?>
	<head>
        <title>Search All Movies for a Choosen Actor</title>
        <meta charset="utf-8" />
	</head>
	<body>
		<h1>Results for <?= $fullname ?></h1>
		<?php
			if ($eric == 'yes')
				$title = "<p>Films with $fullname and Eric Roberts</p>";		
			else
				$title = "<p>Films with $fullname</p>";
		?>
		<table>
			<caption><?=$title ?></caption>
				<?php
					$i = 1;
					while ($row = mysqli_fetch_assoc($results)) {	
				?>					
			        <tr>
			        <td> <?= $i ?> </td>
                    <td><?= $row["name"] ?></td>
                    <td><?= $row["year"] ?></td>
                    </tr>
            	<?php
            		$i++;		
					}
				?>
		</table>
        <?php 
            } else {
            ?>
               <p><?=$fullname ?> and Eric Roberts do not have movies together</p> 
        <?php    
        }
        
	}
	mysqli_close($conn);
    ?>
	</body>
	
<?php include("bottom.html"); ?>
