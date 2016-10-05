
<?php
	include 'config.php'; //IMDB Database settings 

    // Check connection
	$conn = mysqli_connect($servername,$username,$password,$dbname);
	if (!$conn) {
		echo "DB connect error";
		die("Connection failed.");
	}
    
    //Looks up the actor(s) that match the possibly incomplete first/last name
    //names that are typed by users are entered into these variables
    $firstname = $_REQUEST['firstname'];
    $lastname = $_REQUEST['lastname'];
    
    $sql = "select id, first_name, last_name from actors where first_name like '%$firstname%' and last_name like '%$lastname';";


	$stmt = mysqli_query($conn, $sql);  
	

    //outputs the actors as a JSON array.
	$runs = array();
	
	// create an array of all the results
	while ($row = mysqli_fetch_assoc($stmt)) {
		$runs[] = $row;
	}
	
	if ($rows >0) {
		$json_encode($factors);
		print $json;
	}
	else {
		header("HTTP/1.1 404 Not Found");
	}
	
	mysqli_close($conn);

?>
