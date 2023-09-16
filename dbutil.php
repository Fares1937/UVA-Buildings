<?php
class DbUtil{
	public static $loginUser = "userStudent"; 
	public static $loginPass = "";
	public static $host = "localhost"; // Local Host
	public static $schema = "hooshalls"; // Database name 
	
	public static function loginConnection(){
		$db = new mysqli(DbUtil::$host, DbUtil::$loginUser, DbUtil::$loginPass, DbUtil::$schema);
	
		if($db->connect_errno){
			echo("Could not connect to db");
			$db->close();
			exit();
		}
		
		return $db;
	}
	
}
?>