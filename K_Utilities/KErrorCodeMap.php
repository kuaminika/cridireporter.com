<?php

namespace K_Utilities;


class KErrorCodeMap
{
    


    public static function getCodeMap()
    {
        return self::$codeMap;
    }

    private static $codeMap = [
        "exception" => ["description"=>"An Exception occured"]
    ,   "unkwonCode"=> ["description"=>"Error type '%s'  not registered"]
    ,   "alreadyExists"=>["description"=>"Record already exists"]
    ,   "tokenNotFound"=>["description"=>"Token not found"]
    ,   "tokenExpired"=>["description"=>"Token is exipired"]
    ,   "tokenInvald"=>["description"=>"Token is Invalid"]
];

public static function  errorCodeDescription($code)
{
    $result = "";
    if(!key_exists($code,self::$codeMap))
    {    $result = self::$codeMap["unkwonCode"]["description"];
        return $result;
    }

    $result = self::$codeMap[$code]["description"];
    return $result;

}


public static function registerCodeMap($newCodeMap)
{
    foreach (self::$codeMap as $key => $value) 
    {
       if(!key_exists($key,$newCodeMap)) continue;
     
       self::$codeMap[$key] = $newCodeMap[$key];
       
        unset($newCodeMap[$key]);

    }

    self::$codeMap = array_merge(self::$codeMap,$newCodeMap);
}

}


?>