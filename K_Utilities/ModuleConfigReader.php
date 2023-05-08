<?php

//require_once __DIR__."/ModuleConfig.php";

namespace K_Utilities;
class ModuleConfigReader
{
    private $configSetArray;

    private static $currentConfigs;


    public static function createNewConfigs($configArray)
    {
        $result = new ModuleConfigReader($configArray);
        self::$currentConfigs =$result;
        return $result;
    }
    
    public static function getCurrentConfigs()
    {
        $result = isset( self::$currentConfigs)? self::$currentConfigs: new ModuleConfigReader([]);
        return $result;
    }


    public function MSG_ERROR_FETCHING_FILE($path, $defaultMessage = "",$details = "")
    {
        $configName = "MSG_ERROR_FETCHING_FILE";
        $result = $defaultMessage;
        if($this->hasCongfig($configName))
        {
            $result = $this->getConfig($configName);
            return $result;
        }

        $result .= "\n</br>path:".$path;
        $result .= "\n</br>details:".$details;
        return $result;

    }

    
    /**
     * this method creates configs that will not be kept globally
     */
    public static function createLocalConfigSet($configArray)
    {
        $result = new ModuleConfigReader($configArray);
        return $result;
    }

    private function __construct($configArray)
    {
        $this->configSetArray = $configArray;
        
    }


    public function hasCongfig($configName)
    {
        $result = isset($this->configSetArray[$configName]);
        return $result;
    }

    public function setConfig($newConfigName,$value)
    {
        $this->configSetArray[$newConfigName]=$value;
    }

    public function addConfig($newConfigName,$value)
    {
        $this->configSetArray[$newConfigName]=$value;
    }

    public function getConfig( $configName)
    {
        if(!$this->hasCongfig($configName))
        {
            throw new \Exception("Config:".$configName." does not exist");
        }


        $result = $this->configSetArray[$configName];

        return $result;

    }

}