<?php
class Database {
	// private static $host 	    = "192.168.4.91";
	private static $db 		    = "itexpo_2018";
	// private static $username	= "root";
    // private static $password 	= "B248b2a";
    // private static $driver 	    = "mysql";

	private static $host 	    = "localhost";
	// private static $db 		    = "it_expo5";
	private static $username	= "root";
    private static $password 	= "";
    private static $driver 	    = "mysql";

    public static function connect(){
        return new PDO("mysql:host=".self::$host.";dbname=".self::$db, self::$username, self::$password);
    }

}
