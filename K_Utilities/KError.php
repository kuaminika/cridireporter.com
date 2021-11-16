<?php 

namespace K_Utilities;

class KError 
{
   /* private $code;
    private $codeDescription;
    private $message;
    private $location;
*/

    public function __construct($message,$location ="unkown",$code="exception")
    {    
        $this->message = $message;
        $this->location = $location;
        $errorTypeIsKnown = key_exists($code,KErrorCodeMap::getCodeMap());

        
        $this->code =  $errorTypeIsKnown ? $code: "unkwonCode";
        if(  ! $errorTypeIsKnown)
        {
            $this->codeDescription = sprintf( KErrorCodeMap::getCodeMap()[$this->code]["description"],$code);
            return;
        }

        $this->codeDescription = KErrorCodeMap::getCodeMap()[$this->code]["description"];
    }


    



    /**
     * Get the value of code
     */ 
    public function getCode()
    {
        return $this->code;
    }

    /**
     * Set the value of code
     *
     * @return  self
     */ 
    public function setCode($code)
    {
        $this->code = $code;

        return $this;
    }

    /**
     * Get the value of codeDescription
     */ 
    public function getCodeDescription()
    {
        return $this->codeDescription;
    }

    /**
     * Set the value of codeDescription
     *
     * @return  self
     */ 
    public function setCodeDescription($codeDescription)
    {
        $this->codeDescription = $codeDescription;

        return $this;
    }

    /**
     * Get the value of message
     */ 
    public function getMessage()
    {
        return $this->message;
    }

    /**
     * Set the value of message
     *
     * @return  self
     */ 
    public function setMessage($message)
    {
        $this->message = $message;

        return $this;
    }

    /**
     * Get the value of location
     */ 
    public function getLocation()
    {
        return $this->location;
    }

    /**
     * Set the value of location
     *
     * @return  self
     */ 
    public function setLocation($location)
    {
        $this->location = $location;

        return $this;
    }
}