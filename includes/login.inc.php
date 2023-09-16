<?php

if(isset($_POST["submit"])) {
    $compID = $_POST["computingID"];
    $pwd = $_POST["pass_word"];

    require_once 'dbutil.php';
    $db = DbUtil::loginConnection();
    require_once 'functions.inc.php';

    //If user left any input empty
    if(emptyInputLogin($compID, $pwd) !== false) {
        header("location: ../login.php?error=emptyinput");
	exit();	  
    } else if(CompIDnotExists($db, $compID) !== false) { //If computing ID already exists
      	header("location: ../login.php?error=unexistsCID");
	exit();
    } else if(checkLogin($db, $compID, $pwd) !== true) { //If username or pwd not in database
    	header("location: ../login.php?error=wrngCreds");
	exit();
    } else { 
        loginUser($db, $compID, $pwd);
    }
}
else {
     header("location: ../login.php");
     exit();
}
