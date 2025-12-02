<?php 
require_once("server.conf");

class Connection
{
	protected static $connection;
	
	// Connect to your database
	protected static function connect() 
	{
		if(!isset(self::$connection)) 
		{
			// Insert your code here.
		}
	
		if(self::$connection === false) 
		{
			if($GLOBALS['debug'])
			{
				syslog(LOG_INFO, "Mysql Connection failed");
			}
			return false;
		}
		return self::$connection;
	}
	
	// Search for data in your database
	public static function search($sql) 
	{
		$connection = self::connect();
		$return_data = array();
		
		if($connection !== false)
		{
            // Insert your code here.
		}

		return $return_data;
	}
	
    // Insert data in your database
	public static function insert($sql) 
	{
		$connection = self::connect();
		$insert_success = false;
		
		if($connection !== false)
		{
			// Insert your code here.
		}

		return $insert_success;
	}
	
    // Update data in your database
	public static function update($data) 
	{
		$connection = self::connect();
		
		if($connection !== false)
		{
			// Insert your code here.
		}
	}
	
	// Delete data in your database
	public static function delete($sql)
	{
		$connection = self::connect();
		$delete_success = false;
		
		if($connection !== false)
		{
			// Insert your code here.
		}

		return $delete_success;
	}
}
