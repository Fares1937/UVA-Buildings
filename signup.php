<body style="background-color:lightcyan;">
</body>

<?php
	include_once 'header.php';
?>

<center><section class="signup-form">
	 <h2>Sign Up</h2>
	 <form action="includes/signup.inc.php" method="post">
	       <input type="text" name="firstName" placeholder="First Name">
	       <input type="text" name="lastName" placeholder="Last Name">
	       <input type="text" name="computingID" placeholder="Computing ID">
	       <input type="password" name="pass_word" placeholder="Password">
	       <button type="submit" name="submit">Sign Up</button>
	 </form>

        <?php
	if(isset($_GET["error"])) {
	    if($_GET["error"] == "emptyinput") {
	    	echo "<p>Fill in all fields!</p>";
	    } else if($_GET["error"] == "usernametaken") {
	      	echo "<p>This computing ID already exists!</p>";
	    } else if($_GET["error"] == "invalidPwd") {
	      	echo "<p>Your password isn't long enough!</p>";
	    } else if($_GET["error"] == "none") {
	        echo "<p>You have signed up!</p>";
			echo "<a>You can now </a><a href='login.php'>log in</a>";
	    }	
	}
	?>
	
</section></center>

<?php
?>