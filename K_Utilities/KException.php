<?php

namespace K_Utilities;

use Exception;


class KException extends Exception
{
    var $errorModel;

    public function __construct($errorModel)
    {
        $this->message = $errorModel->message;
        $this->errorModel = $errorModel;
    }


    /**
     * Get the value of errorModel
     */ 
    public function getErrorModel()
    {
        return $this->errorModel;
    }

    public static function createWithException(Exception $ex,$location)
    {
        $error = new KError($ex->getMessage(),$location,"exception");
        $result = new KException($error);
        return $result;
    }
}


?>