<?php

include_once 'dbutil.php';
$db = DbUtil::loginConnection();

function emptyInputSignup($firstName, $lastName, $compID, $password) {
	 $result;
	 if (empty($firstName) || empty($lastName) || empty($compID) || empty($password)) {
	    $result = true;
	 }
	 else {
		$result = false;
	}	
	return $result;	
}

function CompIDExists($db, $compID) {
	 $sql = "SELECT * FROM userInfo WHERE computingID = ?;"; //? will use prepared statement
	 $stmt = mysqli_stmt_init($db); //prepared statement
	 if(!mysqli_stmt_prepare($stmt, $sql)) {
	 	header("location: ../signup.php?error=stmtfailed");
		exit();
	 }

	 mysqli_stmt_bind_param($stmt, "s", $compID);
	 mysqli_stmt_execute($stmt);

	 $result = mysqli_stmt_get_result($stmt);

	 if($row = mysqli_fetch_assoc($result)) {
	      return $row;
	 }
	 else {  //for sign up: compID already exists
	      $result = false;
	      return $result;
	 }

	 mysqli_stmt_close($stmt);
}

function invalidPwd($password) {
	$result;
	if(strlen($password) < 6) {
	     $result = true;
	} else {
	     $result = false;
	}
	return $result;
}

function createUser($db, $compID, $firstName, $lastName, $password) {
	 $sql = "INSERT INTO userInfo(computingID, firstName, lastName, pass_word) VALUES (?, ?, ?, ?);";
	 $stmt = mysqli_stmt_init($db);
	 if(!mysqli_stmt_prepare($stmt, $sql)) {
	 	header("location: ../signup.php?error=stmtfailed");
		exit();
	 }

	 mysqli_stmt_bind_param($stmt, "ssss", $compID, $firstName, $lastName, $password);
	 mysqli_stmt_execute($stmt);
	 mysqli_stmt_close($stmt);
	 header("location: ../signup.php?error=none");
	 exit();
}

function createSavedBuilding($db, $compID, $bID) {
	$sql = "INSERT INTO savedBuildings(computingID, bID) VALUES (?, ?);";
	$stmt = mysqli_stmt_init($db);
	
	// if it fails
	if(!mysqli_stmt_prepare($stmt, $sql)) {
		header("location: ../home.php?error=stmtfailed");
	   exit();
	}
	
	mysqli_stmt_bind_param($stmt, "si", $compID, $bID);
	mysqli_stmt_execute($stmt);
	mysqli_stmt_close($stmt);
	header("location: ./profile.php?");
	exit();
}

function createUserRating($db, $compID, $bID, $rating) {
	$check = mysqli_query($db, "SELECT * FROM userRatings
				WHERE computingID = '$compID'
				AND $bID = bID;");

	if(mysqli_num_rows($check)==0){
		echo "check == 0";
		$sql = "INSERT INTO userRatings(computingID, bID, rating) VALUES (?, ?, ?);";
		$stmt = mysqli_stmt_init($db);
	} 
	
	else {
		echo "check != 0";
		$sql = "UPDATE userRatings 
		SET rating = $rating
		WHERE computingID = '$compID'
		AND bID = $bID;";

		$stmt = mysqli_stmt_init($db);
	}

	// if it fails
	if(!mysqli_stmt_prepare($stmt, $sql)) {
		header("location: ../home.php?error=stmtfailed");
	   exit();
	}

	mysqli_stmt_bind_param($stmt, "sii", $compID, $bID, $rating);
	mysqli_stmt_execute($stmt);
	mysqli_stmt_close($stmt);
	header("location: ./profile.php?");
	exit();
}

function deleteUserRating($db, $compID, $bID) {

	$sql = "DELETE FROM userRatings 
			WHERE computingID = '$compID'
			AND bID = $bID;";
			
	$stmt = mysqli_stmt_init($db);

	// if it fails
	if(!mysqli_stmt_prepare($stmt, $sql)) {
		header("location: ./home.php?");
	   exit();
	}
	
	//mysqli_stmt_bind_param($stmt, "si", $compID, $bID);
	mysqli_stmt_execute($stmt);
	mysqli_stmt_close($stmt);
	header("location: ./profile.php?");
	exit();
}

function deleteSavedBuilding($db, $compID, $bID) {

	$sql = "DELETE FROM savedBuildings 
			WHERE computingID = '$compID'
			AND bID = $bID;";
			
	$stmt = mysqli_stmt_init($db);

	// if it fails
	if(!mysqli_stmt_prepare($stmt, $sql)) {
		header("location: ./home.php?");
	   exit();
	}
	
	//mysqli_stmt_bind_param($stmt, "si", $compID, $bID);
	mysqli_stmt_execute($stmt);
	mysqli_stmt_close($stmt);
	header("location: ./profile.php?");
	exit();
}

function emptyInputLogin($compID, $pwd) {
	$result;
	if(empty($compID) || empty($pwd)) {
	    $result = true;
	} else {
	    $result = false;
	}
	return $result;	
}

function checkLogin($db, $compID, $pwd) {
	 $sql = "SELECT * FROM userInfo WHERE computingID = ? AND pass_word = ?;";
	 $stmt = mysqli_stmt_init($db); //prepared statement
	 if(!mysqli_stmt_prepare($stmt, $sql)) {
	 	header("location: ../signup.php?error=stmtfailed");
		exit();
	 }

	 mysqli_stmt_bind_param($stmt, "ss", $compID, $pwd);
	 mysqli_stmt_execute($stmt);

	 $result = mysqli_stmt_get_result($stmt);
	 $count = mysqli_num_rows($result);
	 
	 if($count > 0) {
	 	   $result = true;
	 } else {
	   	   $result = false;
	 }
	 return $result;
}

function CompIDnotExists($db, $compID) {
    $result;
    $cIDExists = CompIDExists($db, $compID);
    if($cIDExists == false) { //compID does not exist
	$result = true;
    } else {
        $result = false;
    }
    return $result;
}

function loginUser($db, $compID, $pwd) {
    $cIDExists = CompIDExists($db, $compID);
    session_start();
    $_SESSION["computingID"] = $cIDExists["computingID"];
    $_SESSION["firstName"] = $cIDExists["firstName"];
    $_SESSION["lastName"] = $cIDExists["lastName"];
	$_SESSION["computingID"] = $cIDExists["computingID"];
    header("location: ../home.php"); //change to profile.php
    exit();
}
