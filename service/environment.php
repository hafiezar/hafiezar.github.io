<?php
class Environment {
    private static $uploadDir   = __DIR__.'/uploads';
    private static $sharedLink  = 'http://localhost/hafiezar.github.io/service/uploads';

    public static function getDir($subDir){
        return self::$uploadDir.$subDir;
    }
    public static function getLink($subDir){
        return self::$sharedLink.$subDir;
    }

    public static function publicHost(){
		$publicHost = '//localhost:8085/index.php';
		return $publicHost;
	}
}
