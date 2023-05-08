<?php

namespace K_Utilities;

use Exception;
class JSONFileReader implements IKfileReader
{

    CONST MSG_ERROR_FETCHING_FILE = "could not open file";
    private $configs;
    public function __construct(ModuleConfigReader $configs )
    {
        $this->configs = $configs;
    }

    public function getFileContent($filePath)
    {
        try
        {
           $file = fopen($filePath,"r");
           
           $rResult =  fread($file,filesize($filePath));

           $result=json_decode( $rResult);
            return $result;
        }
        catch(Exception $ex)
        {
           $defaultMessage=  self::MSG_ERROR_FETCHING_FILE;
           $details =  $ex->getMessage();
           throw new Exception( $this->configs->MSG_ERROR_FETCHING_FILE($filePath,$defaultMessage,$details));
        }
    }
}
