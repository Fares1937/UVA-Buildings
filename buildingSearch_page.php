<!-- sources: 
https://dev.mysql.com/doc/apis-php/en/apis-php-mysqli-result.fetch-assoc.html 
https://www.youtube.com/watch?v=08dt895VKnQ-->
<body style="background-color:lightcyan;">
</body>
<?php
 include_once 'header.php';
 require "dbutil.php";
 $db = DbUtil::loginConnection();

//  $stmt = $db->stmt_init();
$search_result = False;


if( isset($_POST['searchBuildingInput'])) { # if there is input in the search bar
	if( isset($_POST['food_filter']) and isset($_POST['school_filter']) 
	and isset($_POST['location_filter']) and isset($_POST['study_space_filter'])
	and isset($_POST['rating_filter']) ) {
	

	$searchBuildingInput = $_POST['searchBuildingInput'];
	$food_filter = $_POST['food_filter'];
	$school_filter = $_POST['school_filter'];
	$location_filter = $_POST['location_filter'];
	$study_space_filter = $_POST['study_space_filter'];
	$rating_filter = $_POST['rating_filter'];



	$filters = array(array("fsName", $food_filter), array("sName", $school_filter), 
	array("street", $location_filter), array("spaceType", $study_space_filter), 
	array("overall_rating", $rating_filter));

	$used_filters = array_values(array_filter($filters, function($data) {
		return $data[1] != "Select";
	}));

	// var_dump($filters);
	// echo "   ";
	// var_dump($used_filters);
	// echo count($used_filters);

	$num_filters = count($used_filters); 
	// echo $num_filters;
	// echo $used_filters[0][0];
	// echo $used_filters[0][1];

	function filterTable($query) {
		$db = DbUtil::loginConnection();
		$filter_Result = $db ->query($query);
		return $filter_Result;
	}

	if($num_filters == 0) {
		$query = "SELECT DISTINCT bID, bName, photo FROM building WHERE bName like " . "\"%" . $searchBuildingInput . "%\"";
		$search_result = filterTable($query);
	}

	else if($num_filters == 1) {
		$query = "SELECT DISTINCT bID, bName, photo FROM building NATURAL JOIN buildingInfo NATURAL JOIN school NATURAL JOIN foodService 
		NATURAL JOIN studySpace NATURAL JOIN studySpaceType NATURAL JOIN overallRating WHERE bName like " . "\"%" . $searchBuildingInput . "%\"" . 
		" AND " . $used_filters[0][0] . " = " . "\"" . $used_filters[0][1] . "\"";
		$search_result = filterTable($query);
	}

	else if($num_filters == 2) {
		$query = "SELECT DISTINCT bID, bName, photo FROM building NATURAL JOIN buildingInfo NATURAL JOIN school NATURAL JOIN foodService 
		NATURAL JOIN studySpace NATURAL JOIN studySpaceType NATURAL JOIN overallRating WHERE bName like " . "\"%" . $searchBuildingInput . "%\"" . 
		" AND " . $used_filters[0][0] . " = " . "\"" . $used_filters[0][1] . "\"" . 
		" AND " . $used_filters[1][0] . " = " . "\"" . $used_filters[1][1] . "\"";
		$search_result = filterTable($query);
	}

	else if($num_filters == 3) {
		$query = "SELECT DISTINCT bID, bName, photo FROM building NATURAL JOIN buildingInfo NATURAL JOIN school NATURAL JOIN foodService 
		NATURAL JOIN studySpace NATURAL JOIN studySpaceType NATURAL JOIN overallRating WHERE bName like " . "\"%" . $searchBuildingInput . "%\"" . 
		" AND " . $used_filters[0][0] . " = " . "\"" . $used_filters[0][1] . "\"" . 
		" AND " . $used_filters[1][0] . " = " . "\"" . $used_filters[1][1] . "\"" . 
		" AND " . $used_filters[2][0] . " = " . "\"" . $used_filters[2][1] . "\"";
		$search_result = filterTable($query);
	}

	else if($num_filters == 4) {
		$query = "SELECT DISTINCT bID, bName, photo FROM building NATURAL JOIN buildingInfo NATURAL JOIN school NATURAL JOIN foodService 
		NATURAL JOIN studySpace NATURAL JOIN studySpaceType NATURAL JOIN overallRating WHERE bName like " . "\"%" . $searchBuildingInput . "%\"" . 
		" AND " . $used_filters[0][0] . " = " . "\"" . $used_filters[0][1] . "\"" . 
		" AND " . $used_filters[1][0] . " = " . "\"" . $used_filters[1][1] . "\"" . 
		" AND " . $used_filters[2][0] . " = " . "\"" . $used_filters[2][1] . "\"" . 
		" AND " . $used_filters[3][0] . " = " . "\"" . $used_filters[3][1] . "\"";
		$search_result = filterTable($query);
	}

	else if($num_filters == 5) {
		$query = "SELECT DISTINCT bID, bName, photo FROM building NATURAL JOIN buildingInfo NATURAL JOIN school NATURAL JOIN foodService 
		NATURAL JOIN studySpace NATURAL JOIN studySpaceType NATURAL JOIN overallRating WHERE bName like " . "\"%" . $searchBuildingInput . "%\"" . 
		" AND " . $used_filters[0][0] . " = " . "\"" . $used_filters[0][1] . "\"" . 
		" AND " . $used_filters[1][0] . " = " . "\"" . $used_filters[1][1] . "\"" . 
		" AND " . $used_filters[2][0] . " = " . "\"" . $used_filters[2][1] . "\"" . 
		" AND " . $used_filters[3][0] . " = " . "\"" . $used_filters[3][1] . "\"" . 
		" AND " . $used_filters[4][0] . " = " . "\"" . $used_filters[4][1] . "\"";
		$search_result = filterTable($query);
	}
}
else {
	if( isset($_POST['food_filter']) and isset($_POST['school_filter']) 
	and isset($_POST['location_filter']) and isset($_POST['study_space_filter'])
	and isset($_POST['rating_filter']) ) {

	$food_filter = $_POST['food_filter'];
	$school_filter = $_POST['school_filter'];
	$location_filter = $_POST['location_filter'];
	$study_space_filter = $_POST['study_space_filter'];
	$rating_filter = $_POST['rating_filter'];



	$filters = array(array("fsName", $food_filter), array("sName", $school_filter), 
	array("street", $location_filter), array("spaceType", $study_space_filter), 
	array("overall_rating", $rating_filter));

	$used_filters = array_values(array_filter($filters, function($data) {
		return $data[1] != "Select";
	}));

	// var_dump($filters);
	// echo "   ";
	// var_dump($used_filters);
	// echo count($used_filters);

	$num_filters = count($used_filters); 
	// echo $num_filters;
	// echo $used_filters[0][0];
	// echo $used_filters[0][1];

	function filterTable($query) {
		$db = DbUtil::loginConnection();
		$filter_Result = $db ->query($query);
		return $filter_Result;
	}

	if($num_filters == 1) {
		$query = "SELECT DISTINCT bID, bName, photo FROM building NATURAL JOIN buildingInfo NATURAL JOIN school NATURAL JOIN foodService 
		NATURAL JOIN studySpace NATURAL JOIN studySpaceType NATURAL JOIN overallRating WHERE " . 
		$used_filters[0][0] . " = " . "\"" . $used_filters[0][1] . "\"";
		$search_result = filterTable($query);
	}

	else if($num_filters == 2) {
		$query = "SELECT DISTINCT bID, bName, photo FROM building NATURAL JOIN buildingInfo NATURAL JOIN school NATURAL JOIN foodService 
		NATURAL JOIN studySpace NATURAL JOIN studySpaceType NATURAL JOIN overallRating WHERE " . 
		$used_filters[0][0] . " = " . "\"" . $used_filters[0][1] . "\"" . 
		" AND " . $used_filters[1][0] . " = " . "\"" . $used_filters[1][1] . "\"";
		$search_result = filterTable($query);
	}

	else if($num_filters == 3) {
		$query = "SELECT DISTINCT bID, bName, photo FROM building NATURAL JOIN buildingInfo NATURAL JOIN school NATURAL JOIN foodService 
		NATURAL JOIN studySpace NATURAL JOIN studySpaceType NATURAL JOIN overallRating WHERE " . 
		$used_filters[0][0] . " = " . "\"" . $used_filters[0][1] . "\"" . 
		" AND " . $used_filters[1][0] . " = " . "\"" . $used_filters[1][1] . "\"" . 
		" AND " . $used_filters[2][0] . " = " . "\"" . $used_filters[2][1] . "\"";
		$search_result = filterTable($query);
	}

	else if($num_filters == 4) {
		$query = "SELECT DISTINCT bID, bName, photo FROM building NATURAL JOIN buildingInfo NATURAL JOIN school NATURAL JOIN foodService 
		NATURAL JOIN studySpace NATURAL JOIN studySpaceType NATURAL JOIN overallRating WHERE " . 
		$used_filters[0][0] . " = " . "\"" . $used_filters[0][1] . "\"" . 
		" AND " . $used_filters[1][0] . " = " . "\"" . $used_filters[1][1] . "\"" . 
		" AND " . $used_filters[2][0] . " = " . "\"" . $used_filters[2][1] . "\"" . 
		" AND " . $used_filters[3][0] . " = " . "\"" . $used_filters[3][1] . "\"";
		$search_result = filterTable($query);
	}

	else if($num_filters == 5) {
		$query = "SELECT DISTINCT bID, bName, photo FROM building NATURAL JOIN buildingInfo NATURAL JOIN school NATURAL JOIN foodService 
		NATURAL JOIN studySpace NATURAL JOIN studySpaceType NATURAL JOIN overallRating WHERE " . 
		$used_filters[0][0] . " = " . "\"" . $used_filters[0][1] . "\"" . 
		" AND " . $used_filters[1][0] . " = " . "\"" . $used_filters[1][1] . "\"" . 
		" AND " . $used_filters[2][0] . " = " . "\"" . $used_filters[2][1] . "\"" . 
		" AND " . $used_filters[3][0] . " = " . "\"" . $used_filters[3][1] . "\"" . 
		" AND " . $used_filters[4][0] . " = " . "\"" . $used_filters[4][1] . "\"";
		$search_result = filterTable($query);
	}
}
}



}

 ?>

<!DOCTYPE html>

<html>
<head>
    <script src="js/jquery-1.6.2.min.js" type="text/javascript"></script> 
	<script src="js/jquery-ui-1.8.16.custom.min.js" type="text/javascript"></script>
 	<title>Search</title>
	<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
</head>


<body>

	<main role="main" class="inner cover">
	<center><h3>Hoos' Halls</h3></center>
	<br>
	<br>
	<div class="container">
		<form action="buildingSearch_page.php" method="post">

			<input class="xlarge" id="searchBuildingInput" name="searchBuildingInput" type="text" size="90" placeholder="Search for a building!"/>
			<button type="submit" class="btn btn-primary">Search</button>
	</div>
<br>
<br>
	<div class="container">
		<div class="row justify-content-md-center">
			<div class="col-lg-4 border-right">
		<!-- Filter -->
		<label style = "font-size: larger; font-weight: bold;">Filter</label>
		<a href = "buildingSearch_page.php" style="float:right; font-size: smaller">CLEAR ALL</a>
        <hr class="mt-2 mb-3 mr-4"/>
		
			<div class="form-group">
				<label style = "font-size: larger">Food Services: </label>
					<select id = "food_filter" name="food_filter" class="form-control">
						<option>Select</option>
						<option value="Chick-fil-A">Chick-fil-A</option>
						<option value="Bento Sushi">Bento Sushi</option>
						<option value="Ben & Jerry’s">Ben & Jerry’s</option>
						<option value="Subway">Subway</option>
						<option value="Starbucks">Starbucks</option>
						<option value="The Juice Laundry">The Juice Laundry</option>
						<option value="Halal Kitchen">Halal Kitchen</option>
						<option value="El Tako Nako">El Tako Nako</option>
						<option value="Yum Yum Xpress">Yum Yum Xpress</option>
						<option value="Got Dumplings">Got Dumplings</option>
						<option value="Rising Roll">Rising Roll</option>
						<option value="Alderman Cafe">Alderman Cafe</option>
						<option value="Einstein Bros. Bagels">Einstein Bros. Bagels</option>
					</select>
			</div>

			<hr class="mt-2 mb-3 mr-4"/>
				

			<div class="form-group">
				<label style = "font-size: larger">School</label>
				<select id = "school_filter" name="school_filter" class="form-control">
						<option>Select</option>
						<option value="College and Graduate School of Arts and Sciences">College of Arts and Sciences</option>
						<option value="School of Data Science">School of Data Science</option>
						<option value="Darden School of Business">Darden School of Business</option>
						<option value="School of Education and Human Development">School of Education and Human Development</option>
						<option value="Frank Batten School of Leadership and Public Policy">Batten School of Leadership and Public Policy</option>
						<option value="School of Engineering and Applied Science">School of Engineering and Applied Science</option>
						<option value="McIntire School of Commerce">McIntire School of Commerce</option>
						<option value="School of Law">School of Law</option>
						<option value="School of Medicine">School of Medicine</option>
						<option value="School of Continuing and Professional Studies">School of Continuing and Professional Studies</option>
						<option value="School of Nursing">School of Nursing</option>
						<option value="UVA’s College at Wise">UVA’s College at Wise</option>
				</select>

			</div>

			<hr class="mt-2 mb-3 mr-4"/>

			<div class="form-group">
			<label style = "font-size: larger">Location</label>
				<select id = "location_filter" name="location_filter" class="form-control">
						<option>Select</option>
						<option value="160 McCormick Rd">160 McCormick Rd</option>
						<option value="Brooks Hall">Brooks Hall</option>
						<option value="Bryan Hall">Bryan Hall</option>
						<option value="291 McCormick Rd">291 McCormick Rd</option>
						<option value="235 McCormick Rd">235 McCormick Rd</option>
						<option value="Cabell Hall">Cabell Hall</option>
						<option value="180 McCormick Rd">180 McCormick Rd</option>
						<option value="Old Cabell Hall">Old Cabell Hall</option>
						<option value="85 Engineer's Way">85 Engineer's Way</option>
						<option value="1826 University Ave">1826 University Ave</option>
				</select>

			</div>

        <hr class="mt-2 mb-3 mr-4"/>

		<div class="form-group">
			<label style = "font-size: larger">Study Spaces</label>
				<select id = "study_space_filter" name="study_space_filter" class="form-control">
						<option>Select</option>
						<option value="reservable group room">Reservable Group Room</option>
						<option value="outside">Outside</option>
						<option value="student center">Student Center</option>
						<option value="cafe">Cafe</option>
						<option value="indoor table">Indoor Table</option>
						<option value="library">Library</option>
						<option value="picnic table">Picnic Table</option>
						<option value="grass">Grass</option>
						<option value="open study room">Open Study Room</option>
						<option value="rooftop">Rooftop</option>
				</select>

			</div>

			<hr class="mt-2 mb-3 mr-4"/>

			<div class="form-group">
			<label style = "font-size: larger">Rating</label>
				<select id = "rating_filter" name="rating_filter" class="form-control">
						<option>Select</option>
						<option value="1">1</option>
						<option value="2">2</option>
						<option value="3">3</option>
						<option value="4">4</option>
						<option value="5">5</option>
				</select>

			</div>
			<hr class="mt-2 mb-3 mr-4"/>
			<br>

		<button type="submit" class="btn btn-primary">Apply</button>
		</form>

		<script type="text/javascript">
			document.getElementById('food_filter').value = "<?php echo $_POST['food_filter'];?>";
			document.getElementById('school_filter').value = "<?php echo $_POST['school_filter'];?>";
			document.getElementById('searchBuildingInput').value = "<?php echo $_POST['searchBuildingInput'];?>";
			document.getElementById('location_filter').value = "<?php echo $_POST['location_filter'];?>";
			document.getElementById('study_space_filter').value = "<?php echo $_POST['study_space_filter'];?>";
			document.getElementById('rating_filter').value = "<?php echo $_POST['rating_filter'];?>";
		</script>
		
	</div>

	<!-- Search Results -->
	<div class="col col-lg-8">

	<?php


	if (!$search_result) {
		echo "";
		?>
		
		<div class="mx-auto" name = "searchBuildingResult" id="searchBuildingResult" style="float:left;">No Results</div>
	<?php
	}
	else {
		if ($search_result -> num_rows == 0) {
			?>
			<div class="mx-auto" name = "searchBuildingResult" id="searchBuildingResult" style="float:left;">No Results</div>
			<?php
		}
		else {
			while ($row = $search_result->fetch_assoc()) {
				$infopage = "buildingInfo" . $row['bID'] . ".php";
				?>
				<a href="<?php echo $infopage; ?>"> <img src="<?php echo $row['photo']; ?>" width="200" height="100"></a>
				<p><?php echo $row['bName']; ?></p>

				<?php

		}
	}
	}
	$db->close();
		?>

	

</div>
</div>
</div>


	<br/><br/>
</main>
	<!-- index.html - View the source here to see the HTML. Notice the "jquery" scripts at the top of the file!<br/>
	js.zip - <a href="./js.zip">js folder</a> (Download jQuery!) -->

</body>
</html>
