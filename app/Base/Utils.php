<?php

class Utils
{
    public $baseURL;

    public static function getOwnUrl()
    {
        $path = dirname(__FILE__);
        $pieces = explode(DIRECTORY_SEPARATOR, $path);
        return $pieces[count($pieces) - 2];
    }

    public static function getConfig()
    {
        try {
            if (file_exists(self::getOwnUrl() . "/config/configg.json")) {
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