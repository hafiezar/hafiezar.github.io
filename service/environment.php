<?php
class Environment {
    private static $uploadDir   = __DIR__.'/uploads';
    private static $appURL      = 'http://localhost/hafiezar.github.io/production';
    private static $base        = 'http://localhost/hafiezar.github.io/service/index.php';
    private static $sharedLink  = 'http://localhost/hafiezar.github.io/service/uploads';

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
