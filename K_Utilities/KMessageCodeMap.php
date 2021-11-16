<?php

namespace K_Utilities;


class KMessageCodeMap
{
    private $_map;
    /*
     map anatomy
    [

        "code1" => ["language1"=>"desc1"
                    "language2"=>"desc1"]
        ,"code2"=>["language1"=>"desc1"
                    "language2"=>"desc1"]
    ]
    */

    public function __construct($map)
    {
        $this->_map = $map;
        $this->_map["unkownMessage"] =["en"=> ' code "%s" is what is meant to be returned but has no definition'];
    }

    public function getCode($code)
    {
        if(!array_key_exists($code,$this->_map))
        {
            $result =   $this->_map["unkownMessage"];
            $result["en"]=sprintf($result["en"],$code);
            return $result;
        }

        $result = $this->_map[$code];
        return $result;
    }


    public function setCode($code,$description,$language="en")
    {
        if(!array_key_exists($code,$this->_map))
        {
            $this->_map[$code]= [];
        }

        $this->_map[$code] [$language]= $description;
    } 
}