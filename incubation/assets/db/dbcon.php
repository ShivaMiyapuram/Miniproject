<?php
class dbcon{
private static $username="root";
private static $password="";
private static $hostname="localhost";
private static $dbname="db454178302";

private static $con=null;
public static function connect(){
		if(self::$con==null)
		{
			try{
			self::$con=new PDO("mysql:host=".self::$hostname.";"."dbname=".self::$dbname,self::$username,self::$password);
			}
			catch(PDOException $e)
			{
				die($e->getMessage());
			}
		}
		return self::$con;
}

public static function disconnect(){
	self::$con=null;
}
}
?>