<?php
class DbUtil{
	public static $loginUser = "userStudent"; 
	public static $loginPass = "";
	public static $host = "localhost"; // local host
	public static $schema = "hooshalls"; // DB Schema
	
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
