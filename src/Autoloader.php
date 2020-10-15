<?php
/**
 * Created by Bruno Guignard
 */

class Autoloader
{
    public static $sourceFolders = ["/src/"]; // the folder where the autoloader is located

    /**
     * Get the absolute path
     * @return string
     */
    public static function getPath() : string
    {
        return str_replace(['\\', '/src'], ['/', ''],__DIR__);
    }

    /**
     * Get the classname and construct the path of the file to load
     * @param string $className
     * @return void
     */
    public static function load(string $className) : void
    {
        $f = false;
        if(count(self::$sourceFolders) < 2){
            if(!$f){
                self::loadFile(self::getPath() . "/src/" . str_replace("\\", "/", $className) . ".php", $f);
            }
        }
        else{
            foreach (self::$sourceFolders as &$folder){
                if(!$f){
                    self::loadFile(self::getPath() . $folder . str_replace("\\", "/", $className) . ".php", $f);
                }
            }
        }
    }

    /**
     * Include the file
     * @param string $file
     * @param bool $flag
     */
    private static function loadFile(string $file, bool &$flag)
    {
        if (file_exists($file) && is_file($file)) {
            include_once($file);
            $flag = true;
        }
    }
}