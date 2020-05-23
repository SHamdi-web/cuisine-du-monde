<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Untitled Document</title>
</head>

<body>





<?php


Class Database
{
private static $dbHost = "localhost";

private static $dbName = "shamzuuw_test";

private static $dbUser = "shamzuuw_user";

private static $dbHostName = "shamdi.fr";



private static $connection = null;


public static function connect()

{
	try
	{
		self::$connection = new PDO("mysql:host=".self::$dbHost. ";dbname=". self::$dbName, self::$dbUser, self::$dbHostName);
		
	}
	catch(PDOException $e)
	{
	die($e->getMessage());	
	}
	return self::$connection;
}
	
public static function disconnect()
{
	self::$connection = null;
}
}
Database::connect();


?>







</body>
</html>