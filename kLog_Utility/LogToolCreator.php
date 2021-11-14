<?php
namespace Log_Utilities;

require_once dirname(__FILE__)."/EchoLogTool.php";
require_once dirname(__FILE__)."/DBTableLogTool.php";
class LogToolCreator{
    public static function getCreateLogFn($stringLogType)
    {
        $result = self::getLogTool($stringLogType);
        return $result;
    }

//private static function createDBLogFunction
    private static function getLogTool($stringLogType)
    {

        $logTypeFn = ["echo"=>function()
                            {

                                $logTool  = new EchoLogTool("logTool_main");
                                return $logTool;
                            },
                    "db"=>function($dbTool,$settings)
                    {
                        $params = array(
                            "name"=>"REPOSIROTY TESTER",
                           "dbTool"=>$dbTool,
                           "logTableName"=>$settings[ "logToolTableName"]
                        ); 
                        $logTool = new DBTableLogTool($params);
                        return $logTool;
                    }
                ];
        return $logTypeFn[$stringLogType];
    }
}
