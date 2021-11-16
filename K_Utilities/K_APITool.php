<?php

namespace K_Utilities;


class K_APITool{

    public $jsonKeyName = "jsonValue";

    private $requestParams;
    private $postParams;

    private $requestMethod;

    function __construct()
    {
        $this->requestParams = $_REQUEST;
        $this->requestMethod = $_SERVER["REQUEST_METHOD"];
        
        $json = file_get_contents('php://input');
        $json_decoded = [$this->jsonKeyName =>json_decode($json)];
    
        $this->postParams = array_merge($_POST,$json_decoded);
        unset($this->postParams["context"]);
        unset($this->postParams["requestAction"]);
    }

    public function getPostParams()
    {
        return $this->postParams;
    }
    public function getRequestMethod()
    {
     return $this->requestMethod;
    }
    public function getRequestParams()
    {
        return $this->requestParams;
    }
}