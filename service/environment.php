<?php
class Environment {
    private static $uploadDir   = __DIR__.'/uploads';
    private static $appURL      = 'http://ft.unj.ac.id/ptik/production';
    private static $base        = 'http://103.8.12.212:33722/index.php';
    private static $sharedLink  = 'http://103.8.12.212:33722/uploads';

    public static function getDir($subDir){
        return self::$uploadDir.$subDir;
    }
    public static function getLink($subDir){
        return self::$sharedLink.$subDir;
    }
    public static function publicHost(){
		return self::$base;
	}
    public static function getAppURL(){
		return self::$appURL;
	}

}
