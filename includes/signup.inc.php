<?php

if(isset($_POST["submit"])) {

    $firstName = $_POST["firstName"];
    $lastName = $_POST["lastName"];
    $compID = $_POST["computingID"];
    $password = $_POST["pass_word"];

    require_once 'dbutil.php';
    $db = DbUtil::loginConnection();
    require_once 'functions.inc.php';

    //If user left any input empty
    if(emptyInputSignup($firstName, $lastName, $compID, $password) !== false) { //if it's anything besides false
        header("location: ../signup.php?error=emptyinput");
	exit();
    } else if(CompIDExists($db, $compID) !== false) { //If computingID already exists
        header("location: ../signup.php?error=usernametaken");
	exit();
    } else if(invalidPwd($password) !== false) { //If password is not long enough
        header("location: ../signup.php?error=invalidPwd");
	exit();
    } else {
      	createUser($db, $compID, $firstName, $lastName, $password);
    }
}
else {
     header("location: ../signup.php");
     exit();
}