<body style="background-color:lightcyan;">
</body>

<?php
 include_once 'header.php';
 ?>

<html>
	<head>
    <script src="js/jquery-1.6.2.min.js" type="text/javascript"></script> 
	<script src="js/jquery-ui-1.8.16.custom.min.js" type="text/javascript"></script>
 	<title>Home</title>
	<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
	</head>

	<body>

	<?php
	   if(isset($_SESSION["firstName"])) {

	      echo "<center><p>Hello " . $_SESSION["firstName"] . "!</p></center>";
           }
	?>

	<div class="container justify-content-center">
	<center><h1>Welcome to Hoos' Halls</h1></center>
	<center><p>This application is intended to provide University of Virginia students with more information about Grounds!</p></center>
</div>
  </body>
</html>
