<head>
    <script src="js/jquery-1.6.2.min.js" type="text/javascript"></script> 
	<script src="js/jquery-ui-1.8.16.custom.min.js" type="text/javascript"></script>
 	<title>Search</title>
	<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
</head>


<body style="background-color:lightcyan;">
</body>

<div class="container">
<html>
   <?php
	include_once('./includes/functions.inc.php');
	include('./header.php');
	$dbconn = DbUtil::loginConnection();
	$con = new mysqli(DbUtil::$host, DbUtil::$loginUser, DbUtil::$loginPass, DbUtil::$schema);
	?>
	
	<form method="post">
   		<input type="submit" name="save" class ="bbtn btn-primary" value="Save Building">
	</form>
   <?php
   			if(array_key_exists('save', $_POST)) {
				$compID = $_SESSION["computingID"];
    			$bID = 10;
				createSavedBuilding($dbconn, $compID, $bID);
			}
		?>
</html>



<!-- USER RATING -->
<html>

<form method="post">
	       <input type="text" name="rating" placeholder="Insert a rating from 1-5">
	       <button type="submit" name="rate" class ="bbtn btn-warning">Rate!</button>
</form>
		</div>
<?php
			$dbconn = DbUtil::loginConnection();
			$con = new mysqli(DbUtil::$host, DbUtil::$loginUser, DbUtil::$loginPass, DbUtil::$schema);

   			if(isset($_POST["rate"])) {
				$compID = $_SESSION["computingID"];
    			$bID = 10;
				$rating = intval($_POST["rating"]);
				
				// rating needs to be what the user types in the box
				createUserRating($dbconn, $compID, $bID, $rating);
			}
?>
</html>

<center>
<html>
	<body>Overall Rating:</body>
	<?php
		$sql = "SELECT overall_rating 
				FROM overallRating
				WHERE bID = 10;";

		$result = mysqli_query($con,$sql);

		if (!$result) {
			printf("Error: %s\n", mysqli_error($con));
			exit();
		}

		// Print the data from the table row by row
		if(mysqli_num_rows($result)==0) {
			echo "N/A";
		} else {
			while ($row = $result->fetch_assoc()) {
				echo $row['overall_rating'] . "/5";
			}
		}
			echo "<br>";
		?>
</html>

<?php

	$db = DbUtil::loginConnection();
	
	$stmt = $db->stmt_init();
	
	if($stmt->prepare("select * from building where bid = 10") or die(mysqli_error($db))) {

		$stmt->execute();
		$stmt->bind_result($bid, $bName, $photo);
		while($stmt->fetch()) {
		}
				?>
		 <img src="<?php echo $photo; ?>" width="400" height="200"></a>



			<span style="color:#0511ff; font-family:courier; font-size:3em; text-align:center;"><p><?php echo $bName;?></p></span>
		<br>
		<?php

		$stmt->close();
	}
	
	$db->close();


?>

	<?php

	$db = DbUtil::loginConnection();
	
	$stmt = $db->stmt_init();
	
	if($stmt->prepare("select * from schoolInfo where numStudents = 11786") or die(mysqli_error($db))) {
		$stmt->execute();
		$stmt->bind_result($sName, $numStudents);
		while($stmt->fetch()) {
		}
		?>
		 </a>
			<span style="color:#ff7e0c;font-family:courier; text-align:center;"><p><?php echo 'This building belongs to: '; echo $sName;?></p></span>
		<br>
		<?php

		$stmt->close();

	}
	
	$db->close();

?>
		<?php
	$db = DbUtil::loginConnection();
	
	$stmt = $db->stmt_init();
	
	if($stmt->prepare("select * from buildingInfo where yearOfConstruction = 2009") or die(mysqli_error($db))) {
		$stmt->execute();
		$stmt->bind_result($bName, $sid, $microwave, $yearOfConstruction, $street, $city);
		while($stmt->fetch()) {
		}
		?>
		 </a>
			<span style="color:#ff7e0c;font-family:courier; text-align:center;"><p><?php echo 'This building was built in '; echo $yearOfConstruction; echo '&nbsp'; echo 'and is located at ';   echo $street; echo','; echo '&nbsp'; echo $city?></p></span>
		<br>
		<?php

		$stmt->close();


	}
	
	$db->close();



?>

<?php

$db = DbUtil::loginConnection();

$query = "SELECT bID, spaceID, spaceType from studySpaceType NATURAL JOIN studySpace WHERE bid = 10 GROUP By spaceType";
$result = $db ->query($query);

echo '<span style="color:#0511ff;text-decoration: underline; font-family:courier; text-align:center;"> The available study spaces at this building are: </span>'; 

while ($row = $result->fetch_assoc()) {
	?> 
			<span style="color:#ff7e0c;font-family:courier; text-align:;"><p><?php echo "&#8226"; echo $row['spaceType'];?></p></span>

	<?php

}


	$db->close();

?>
		<?php
	$db = DbUtil::loginConnection();
	
	$stmt = $db->stmt_init();
	
	if($stmt->prepare("select * from foodService where bID = 10") or die(mysqli_error($db))) {
		$stmt->execute();
		$stmt->bind_result($fsID, $bID, $fsName);
		while($stmt->fetch()) {
		}
		?>
		 </a>
		<span style="color:#0511ff;text-decoration: underline; font-family:courier; text-align:;">	<p><?php echo 'You can find the following restaurant at this bulding: '; echo $fsName;?></p>




			<span style="color:#ff7e0c; font-family:courier; text-align:;"><p><?php echo 'This building has'; echo '&nbsp'; echo $microwave; echo '&nbsp'; echo 'microwave';?></p></span></span>
		<br>
		<?php

		$stmt->close();

	}
	
	$db->close();
?>
<?php

$db = DbUtil::loginConnection();

$query = "SELECT * from meetingRoom where bID = 10";
$result = $db ->query($query);

echo '<span style="color:#0511ff;text-decoration: underline; font-family:courier; text-align:;"> This building has meeting rooms numbered: </span>'; 

while ($row = $result->fetch_assoc()) {
	?> 
		<span style="color:#ff7e0c;font-family:courier; text-align:;">	<p><?php echo $row['roomNumber'];?></p></span>

	<?php

}


	$db->close();

?>



