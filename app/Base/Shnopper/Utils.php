<?php

namespace Shnopper;

use Exception;
use PDO;

class Utils
{
    public $baseURL;

    public static function getOwnUrl()
    {
        $path = dirname(__FILE__);
        $pieces = explode(DIRECTORY_SEPARATOR, $path);
        return $pieces[count($pieces) - 3];
    }

    public static function getConfig()
    {
        try {
            if (file_exists(self::getOwnUrl() . "/config/config.json")) {
                $configRaw = file_get_contents(self::getOwnUrl() . "/config/config.json", true);
                if ($configRaw) {
                    return json_decode($configRaw, true);
                }
            } else {
                throw new Exception(self::getOwnUrl() . "/config/config.json" . " is missing.");
            }
        } catch (Exception $e) {
            self::displayException($e);
        }
    }

    /**
     * Parses basic PDO options from config file
     * @return mixed
     */
    public static function prepareDB(){
        $d = self::getConfig()['database'];
        $f = $d['options'];
        $d['options'] = [];
        if(str_contains($f, "obj")){
            array_push($d['options'], [PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_OBJ]);
        }
        if(str_contains($f, "dev")){
            array_push($d['options'],[PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION]);
        }
        if(str_contains($f, "emulateprepares")){
            array_push($d['options'],[
                PDO::ATTR_EMULATE_PREPARES => false,
            ]);
        }
        return $d;
    }

    public static function displayException(Exception $e)
    {
        echo "
        <div class='shnopper-exception' style='padding:0.5rem; font-family: Comic Sans MS; position: absolute; z-index: 100;width: 98%;height: 100vh;background-color: pink;'>
          <h1>Caught new exception: " . $e->getMessage() . "</h1>
          <code>". $e->getFile() ." on line " . $e->getLine() ."</code><br>
          <code>". $e->getTraceAsString() ."</code>
        </div>
        ";
    }
}