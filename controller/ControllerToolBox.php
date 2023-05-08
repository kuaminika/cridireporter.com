<?php 

namespace crdireporter\controller;
use Log_Utilities\LogToolCreator;
class ControllerToolBox
{
    public function __construct($param)
    {
        $this->messageMap = $param["messageMap"]; 
        $this->requestAction = $param["requestAction"];
        $this->requestParams = $param["requestParams"];
        $this->requestMethod = $param["requestMethod"];
        $this->logTool = $param["logTool"];
    }

    private static function getBlankCreateParams()
    {
        $result = array("context"      =>"NotFoundContext"
                       ,"configs"      =>\crdireporter\ModuleConfigReader::getCurrentConfigs()
                       ,"requestAction"=>"NotFoundMethod"
                       ,"requestParams" => array()
                       ,"requestMethod" =>"GET");

        return $result;

    }

    public static function createNew( $createParams)
    {

        $createParams = isset( $createParams) ? $createParams : self::getBlankCreateParams();
        
        $configs = isset($createParams["configs"])? $createParams["configs"]:\crdireporter\ModuleConfigReader::getCurrentConfigs();        
        $logConfigs = $configs->getConfig("logConfig");
        $logTool  = LogToolCreator::getCreateLogFn($logConfigs->type)();
        $logTool->toggleActivation($logConfigs->active);

        $messageMap = new \K_Utilities\KMessageCodeMap((array) $configs->getConfig("messageMap"));
        $param = array(
            "messageMap" => $messageMap
           ,"requestAction"  => isset($createParams["requestAction"]) ? $createParams["requestAction"]:"index"
           ,"requestParams"  => $createParams["requestParams"]
           ,"requestMethod"  => isset($createParams["requestMethod"]) ? $createParams["requestMethod"]:"GET"
           ,"logTool"        => $logTool
       ); 

       $result = new ControllerToolBox($param);
       return $result;
    }

    
    public function getRequestParams()
    {
        return $this->requestParams;
    }

    public function getRequestAction()
    {
        return $this->requestAction;
    }
    public function getRequestMethod()
    {
        return $this->requestMethod;
    }

    public function getMessageMap()
    {
        return $this->messageMap;
    }
}