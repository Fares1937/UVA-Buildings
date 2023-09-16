<body style="background-color:lightcyan;">
</body>

<html>
    <head>
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.7/css/bootstrap.min.css">
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
    </head>

<?php
    include('./dbutil.php');
    include('./header.php');
    require_once('./dbutil.php');
    include_once('./includes/functions.inc.php');
    $con = new mysqli(DbUtil::$host, DbUtil::$loginUser, DbUtil::$loginPass, DbUtil::$schema);
    
    // Check connection
    if (mysqli_connect_errno()) {
        echo("Can't connect to MySQL Server. Error code: " . mysqli_connect_error());
        return null;
    }
?>
    
<body class="justify-content-center">

<div class="container ml-5"> 
<h3>Profile</h3>

<?php
    echo '<div style="font-size:1.75em;"> <span style="font-size:1.75em;">'.$_SESSION["firstName"], " ", $_SESSION["lastName"], " (", $_SESSION["computingID"], ") ".'</span></div>';
    echo "<br>";
?>   

<div class="col-4">
<h2>Your Ratings</h2> <html>
    <h8><a href='buildingSearch_page.php' >Add Rating</a></h8>
</html>

<hr class="mt-2 mb-3 mr-4"/>

<?php
    // Form the SQL query (a SELECT query)
    $cID = $_SESSION["computingID"];

    $sql="SELECT * 
            FROM userRatings 
            NATURAL JOIN building 
            WHERE computingID = '$cID'
            ORDER BY bID";
            
    $result = mysqli_query($con,$sql);

    if (!$result) {
        printf("Error: %s\n", mysqli_error($con));
        exit();
    }

    // Print the data from the table row by row
    while($row = mysqli_fetch_array($result)) {
        $infopage = "buildingInfo" . $row['bID'] . ".php";
        ?>
            <p><?php echo $row['bName'] . " - Your Rating: " . $row['rating'] . " - ";?><a href = "<?php echo $infopage; ?>">Edit</a>
        
        <!-- The button -->
        <!-- DELETE BUILDING -->
        <html>
            <?php
	        //include_once('./includes/functions.inc.php');
	        //include('./header.php');
	        //$dbconn = DbUtil::loginConnection();
	        //$con = new mysqli(DbUtil::$host, DbUtil::$loginUser, DbUtil::$loginPass, DbUtil::$schema);
	        ?>
	
	        <form method="post">
   		        <input type="submit" name="delete" class ="bbtn btn-danger btn-sm" value="Delete"/>
	        </form>
            <?php
   			if(array_key_exists('delete', $_POST)) {
				$compID = $_SESSION["computingID"];
    			$bID = intval($row['bID']);
				deleteUserRating($db, $compID, $bID);
			}
		    ?>
</html>

        </p>
            
        <?php
    } 
    echo "<br>";
?>

<?php
    echo "<br>";


?>

<html>
    <h2>Saved Buildings</h2>
    <hr class="mt-2 mb-3 mr-4"/>
</html>
<?php
    // Form the SQL query (a SELECT query)
    $cID = $_SESSION["computingID"];

    $sql="SELECT * 
            FROM savedBuildings 
            NATURAL JOIN building 
            WHERE computingID = '$cID'
            ORDER BY bID";
    $result = mysqli_query($con,$sql);

    if (!$result) {
        printf("Error: %s\n", mysqli_error($con));
        exit();
    }

    // Print the data from the table row by row
    while($row = mysqli_fetch_array($result)) {
        echo $row['bName'];
        echo "<br>";
    ?>
    <html>
    <!-- The button -->
    <!-- DELETE SAVED BUILDING -->
	        <form method="post">
   		        <input type="submit" name="deleteSaved" class ="bbtn btn-danger btn-sm" value="Delete"/>
	        </form>
            <?php
   			if(array_key_exists('deleteSaved', $_POST)) {
				$compID = $_SESSION["computingID"];
    			$bID = intval($row['bID']);
				deleteSavedBuilding($db, $compID, $bID);
			}
		    
    }   ?>
    </html>

<?php
    mysqli_close($con); ?>
</div>
</div>
</body>
</html>