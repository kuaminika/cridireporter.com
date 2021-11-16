<?php

namespace K_Utilities;
require_once dirname(__FILE__)."/KMessageCodeMap.php";
// require_once dirname(__FILE__)."/../DB_Utilities/MYSQL_DBTool.php";
// require_once dirname(__FILE__)."/../Log_Utilities/LogToolCreator.php";
require_once dirname(__FILE__)."/ModuleConfigReader.php";
class KIgniter
{


    public static function Ignite()
    {
        // global $globalSettings,$dbSetUpConfigs; 
        $configPath = __DIR__."/../ModuleConfig.json";
            
        // $servername = $dbSetUpConfigs["servername"];
        // $username =  $dbSetUpConfigs["username"];
        // $password =  $dbSetUpConfigs["password"];
        // $dbname =  $dbSetUpConfigs["dbname"];         

                    
        //todo make dbtool creator
       // $dbTool =  new \DB_Utilities\MYSQL_DBTool($servername,$username,$password,$dbname);
    
        // $dbTool->connectToDB();
        // $currentDBLogTool  = \Log_Utilities\LogToolCreator::getCreateLogFn("db")($dbTool,$settings);

        // $currentDBLogTool->log("hihi im here :)");
        $configReader =  ModuleConfigReader::createNewConfigs([] );

        $configReaderJSON = new  JSONFileReader($configReader);
        
       $configs= (array) $configReaderJSON->getFileContent($configPath);

     


        $configReader =  ModuleConfigReader::createNewConfigs($configs );

        return $configReader;
        // $configs->addConfig("currentLogTool",$currentDBLogTool);
        // $configs->addConfig("currentDBLogTool",$currentDBLogTool);
        // $configs->addConfig("currentDbTool",$dbTool);
    }



}


?>