<body style="background-color:lightcyan;">
</body>
<?php
	include_once 'header.php';
?>

<html>
<head>
    <script src="js/jquery-1.6.2.min.js" type="text/javascript"></script> 
	<script src="js/jquery-ui-1.8.16.custom.min.js" type="text/javascript"></script>
 	<title>Login</title>
	<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
	</head>
	<body>


<center><section class="signup-form">
	 <h2>Log In</h2>
	 <form action="includes/login.inc.php" method="post">
	       <input type="text" name="computingID" placeholder="Computing ID">
	       <input type="password" name="pass_word" placeholder="Password">
	       <button type="submit" name="submit">Log In</button>
	 </form>

	 <?php
	 if(isset($_GET["error"])) {
	     if($_GET["error"] == "emptyinput") {
	         echo "<p>Fill in all fields!</p>";
	     } else if ($_GET["error"] == "unexistsCID") {
	         echo "<p>This computing ID doesn't exist!</p>";
	     } else if ($_GET["error"] == "wrngCreds") {
	         echo "<p>Incorrect computing ID or password!</p>";
	     }
	 }
	 ?>
</section></center>
<br>

<center><a> Don't have an account? </a><a href="signup.php">Click here to sign up!</a></center>


